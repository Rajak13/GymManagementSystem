<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
requireLogin();

$user = [];
$metrics = [];
$activity_percentage = 0;
$recommended_plan = null;
$workout_plans = [];
$nutrition_plans = [];
$upcoming_sessions = [];
$featured_trainers = [];
$calendar_days = [];
$workout_logs = [];
$weekly_plan = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['get_recommendation'])) {
    try {
        $fitness_level = $_POST['fitness_level'];
        $goal = $_POST['goal'];
        $days = $_POST['days'] ?? [];

        $stmt = $pdo->prepare("SELECT * FROM workout_plans WHERE fitness_level = ? AND goal = ? ORDER BY RAND()");
        $stmt->execute([$fitness_level, $goal]);
        $plans = $stmt->fetchAll();

        if (empty($plans)) {
            throw new Exception("No workout plans found for your selected criteria");
        }

        $workout_days = array_slice($days, 0, 5);
        $weekly_plan = [];
        foreach ($workout_days as $day) {
            if (!empty($plans)) {
                $random_plan = $plans[array_rand($plans)];
                $weekly_plan[$day] = [
                    'name' => $random_plan['name'] ?? 'Custom Workout',
                    'fitness_level' => $random_plan['fitness_level'] ?? 'beginner',
                    'goal' => $random_plan['goal'] ?? 'general'
                ];
            }
        }

        $_SESSION['weekly_plan'] = $weekly_plan;
        header("Location: members.php#dashboard");
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: members.php#recommendationModal");
        exit();
    }
}

try {
    $user_stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $user_stmt->execute([$_SESSION['user_id']]);
    $user = $user_stmt->fetch(PDO::FETCH_ASSOC) ?: [];

    $metrics_stmt = $pdo->prepare("SELECT * FROM user_metrics WHERE user_id = ?");
    $metrics_stmt->execute([$_SESSION['user_id']]);
    $metrics = $metrics_stmt->fetch(PDO::FETCH_ASSOC) ?: [];

    $activity_stmt = $pdo->prepare("SELECT COUNT(*) FROM workout_logs WHERE user_id = ? AND workout_date BETWEEN ? AND ?");
    $start_week = date('Y-m-d', strtotime('monday this week'));
    $end_week = date('Y-m-d', strtotime('sunday this week'));
    $activity_stmt->execute([$_SESSION['user_id'], $start_week, $end_week]);
    $workouts_this_week = $activity_stmt->fetchColumn();
    $activity_percentage = min(($workouts_this_week / 5) * 100, 100);

    if (!empty($metrics)) {
        $fitness_level = determine_fitness_level($metrics);
        $plan_stmt = $pdo->prepare("SELECT * FROM workout_plans WHERE goal = ? AND fitness_level = ? ORDER BY duration_weeks ASC LIMIT 1");
        $plan_stmt->execute([$metrics['fitness_goal'] ?? 'build', $fitness_level]);
        $recommended_plan = $plan_stmt->fetch(PDO::FETCH_ASSOC);
    }

    $workout_stmt = $pdo->prepare("SELECT * FROM workout_plans");
    $workout_stmt->execute();
    $workout_plans = $workout_stmt->fetchAll(PDO::FETCH_ASSOC);

    $nutrition_stmt = $pdo->prepare("SELECT * FROM nutrition_plans");
    $nutrition_stmt->execute();
    $nutrition_plans = $nutrition_stmt->fetchAll(PDO::FETCH_ASSOC);

    $weekly_plan = $_SESSION['weekly_plan'] ?? [];
    unset($_SESSION['weekly_plan']);

    $session_stmt = $pdo->prepare("SELECT s.*, t.name AS trainer_name FROM bookings b JOIN sessions s ON b.session_id = s.id JOIN trainers t ON s.trainer_id = t.id WHERE b.user_id = ? AND s.session_date >= CURDATE() ORDER BY s.session_date ASC LIMIT 3");
    $session_stmt->execute([$_SESSION['user_id']]);
    $upcoming_sessions = $session_stmt->fetchAll(PDO::FETCH_ASSOC);

    $trainer_stmt = $pdo->prepare("SELECT * FROM trainers WHERE status = 'active' ORDER BY RAND() LIMIT 2");
    $trainer_stmt->execute();
    $featured_trainers = $trainer_stmt->fetchAll(PDO::FETCH_ASSOC);

    $log_stmt = $pdo->prepare("SELECT * FROM workout_logs WHERE user_id = ? ORDER BY workout_date DESC LIMIT 5");
    $log_stmt->execute([$_SESSION['user_id']]);
    $workout_logs = $log_stmt->fetchAll(PDO::FETCH_ASSOC);

    $calendar_days = generate_calendar_days($_SESSION['user_id'], $pdo);

} catch (PDOException $e) {
    error_log("Database error: " . $e->getMessage());
}

function determine_fitness_level($metrics) {
    if (($metrics['body_fat'] ?? 0) < 15 && ($metrics['activity_level'] ?? '') === 'active') return 'advanced';
    if (($metrics['body_fat'] ?? 0) < 25 && ($metrics['activity_level'] ?? '') === 'moderate') return 'intermediate';
    return 'beginner';
}

function generate_calendar_days($user_id, $pdo) {
    $days = [];
    try {
        $date = new DateTime();
        $date->modify('first day of this month');
        $first_day = $date->format('w');
        $total_days = $date->format('t');

        $workout_days_stmt = $pdo->prepare("SELECT DISTINCT workout_date FROM workout_logs WHERE user_id = ? AND MONTH(workout_date) = MONTH(CURDATE())");
        $workout_days_stmt->execute([$user_id]);
        $workout_dates = $workout_days_stmt->fetchAll(PDO::FETCH_COLUMN);

        for ($i = 0; $i < 42; $i++) {
            $day = ['day' => '', 'active' => false, 'has_workout' => false];
            if ($i >= $first_day && $i < ($first_day + $total_days)) {
                $current_day = $i - $first_day + 1;
                $day['day'] = $current_day;
                $day['active'] = ($current_day == date('j'));
                $formatted_date = date('Y-m-') . str_pad($current_day, 2, '0', STR_PAD_LEFT);
                $day['has_workout'] = in_array($formatted_date, $workout_dates);
            }
            $days[] = $day;
        }
    } catch (Exception $e) {
        error_log("Calendar error: " . $e->getMessage());
    }
    return $days;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    try {
        $stmt = $pdo->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ? WHERE id = ?");
        $stmt->execute([$_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['phone'], $_SESSION['user_id']]);
        header("Location: members.php");
        exit();
    } catch (PDOException $e) {
        error_log("Profile update error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ARA Fitness</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #DC3545; /* Red */
            --primary-hover: #c82333; /* Darker red for hover */
            --secondary: #6C757D;
            --accent: #DC3545; /* Red */
            --dark: #343A40;
            --text-primary: #212529;
            --text-secondary: #6C757D;
            --border-color: #DEE2E6;
            --card-bg: #FFFFFF; /* White */
            --card-hover: #F8F9FA;
            --success: #28A745;
            --warning: #FFC107;
            --danger: #DC3545; /* Red */
            --gradient-primary: linear-gradient(135deg, #DC3545 0%, #FF6B6B 100%); /* Red gradient */
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow: 0 2px 4px rgba(0,0,0,0.1);
            --shadow-lg: 0 4px 6px rgba(0,0,0,0.1);
        }

        body {
            background: var(--card-bg); /* White */
            color: var(--text-primary);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: var(--card-bg); /* White */
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
        }

        .nav-link {
            color: var(--text-secondary) !important;
            transition: color 0.2s;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary) !important; /* Red */
        }

        .card {
            background: var(--card-bg); /* White */
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            transition: transform 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .metric-item {
            padding: 1rem;
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            text-align: center;
            background: var(--card-bg); /* White */
        }

        .btn-primary {
            background: var(--primary); /* Red */
            border: none;
        }

        .btn-primary:hover {
            background: var(--primary-hover); /* Darker red */
        }

        .progress {
            height: 1.5rem;
            background: var(--border-color);
        }

        .progress-bar {
            background: var(--primary); /* Red */
        }

        .badge {
            padding: 0.5em 0.75em;
        }

        .form-control {
            background: var(--card-bg); /* White */
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        .form-control:focus {
            border-color: var(--primary); /* Red */
            box-shadow: 0 0 0 0.2rem rgba(220,53,69,.25); /* Red focus shadow */
        }

        .modal-content {
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="bi bi-lightning-charge fs-3 text-primary me-2"></i>
                <span class="fw-bold">ARA Fitness</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="bi bi-list text-primary"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" href="#dashboard"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#workouts"><i class="bi bi-activity me-1"></i> Workouts</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#nutrition"><i class="bi bi-nutrition me-1"></i> Nutrition</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#profile"><i class="bi bi-person me-1"></i> Profile</a>
                    </li>
                </ul>
                <button class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#recommendationModal">
                    <i class="bi bi-magic me-2"></i>Get Plan
                </button>
            </div>
        </div>
    </nav>

    <!-- Recommendation Modal -->
    <div class="modal fade" id="recommendationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title"><i class="bi bi-magic me-2"></i>Get Personalized Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Fitness Level</label>
                            <select name="fitness_level" class="form-select" required>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Primary Goal</label>
                            <select name="goal" class="form-select" required>
                                <option value="lose">Lose Weight</option>
                                <option value="maintain">Maintain</option>
                                <option value="build">Build Muscle</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Available Days/Week</label>
                            <div class="d-flex flex-wrap gap-2">
                                <?php foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day): ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="days[]" value="<?= $day ?>">
                                        <label class="form-check-label"><?= substr($day, 0, 3) ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" name="get_recommendation" class="btn btn-primary w-100">Generate Plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <main class="container pt-5 mt-4">
        <!-- Dashboard Section -->
        <section id="dashboard" class="py-5">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <div class="mb-4">
                                <div class="avatar-icon bg-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 150px; height: 150px;">
                                    <i class="bi bi-person fs-1 text-white"></i>
                                </div>
                                <h3 class="mt-3"><?= htmlspecialchars($user['first_name'] ?? 'User') ?> <?= htmlspecialchars($user['last_name'] ?? '') ?></h3>
                                <p class="text-secondary">Member Since <?= isset($user['created_at']) ? date('Y', strtotime($user['created_at'])) : 'N/A' ?></p>
                            </div>
                            <div class="row g-3">
                                <?php
                                $metrics_data = [
                                    ['icon' => 'speedometer2', 'title' => 'Weight', 'value' => ($metrics['weight'] ?? '--') . ' kg'],
                                    ['icon' => 'rulers', 'title' => 'Height', 'value' => ($metrics['height'] ?? '--') . ' cm'],
                                    ['icon' => 'heart-pulse', 'title' => 'BFP', 'value' => ($metrics['body_fat'] ?? '--') . '%'],
                                    ['icon' => 'activity', 'title' => 'Activity', 'value' => ucfirst($metrics['activity_level'] ?? '--')]
                                ];
                                foreach ($metrics_data as $metric): ?>
                                    <div class="col-6">
                                        <div class="metric-item">
                                            <i class="bi bi-<?= $metric['icon'] ?> fs-4 text-primary mb-2"></i>
                                            <h5 class="mb-1"><?= $metric['value'] ?></h5>
                                            <small class="text-secondary"><?= $metric['title'] ?></small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <?php if (!empty($weekly_plan)): ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h4 class="mb-4"><i class="bi bi-calendar-week me-2"></i>Your Weekly Plan</h4>
                                <div class="row g-3">
                                    <?php foreach ($weekly_plan as $day => $plan): ?>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header bg-primary text-white"><?= $day ?></div>
                                                <div class="card-body">
                                                    <h5><?= $plan['name'] ?? 'Custom Workout' ?></h5>
                                                    <p class="text-secondary"><?= ucfirst($plan['fitness_level'] ?? 'General') ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="mb-3"><i class="bi bi-graph-up me-2"></i>Weekly Progress</h4>
                            <div class="progress mb-2">
                                <div class="progress-bar" style="width: <?= $activity_percentage ?>%" role="progressbar" aria-valuenow="<?= $activity_percentage ?>" aria-valuemin="0" aria-valuemax="100"><?= round($activity_percentage) ?>%</div>
                            </div>
                            <p class="text-secondary small">Workouts completed this week: <?= $workouts_this_week ?? 0 ?>/5</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Workouts Section -->
        <section id="workouts" class="py-5">
            <h2 class="mb-4"><i class="bi bi-lightning-charge me-2"></i>Workout Programs</h2>
            <div class="row g-4">
                <?php foreach ($workout_plans as $plan): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="path/to/workout-image.jpg" class="card-img-top" alt="<?= $plan['name'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $plan['name'] ?></h5>
                                <p class="card-text"><?= $plan['description'] ?></p>
                                <div class="mb-3">
                                    <span class="badge bg-primary"><?= ucfirst($plan['fitness_level']) ?></span>
                                    <span class="badge bg-secondary"><?= ucfirst($plan['goal']) ?></span>
                                </div>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Nutrition Section -->
        <section id="nutrition" class="py-5">
            <h2 class="mb-4"><i class="bi bi-nutrition me-2"></i>Nutrition Plans</h2>
            <div class="row g-4">
                <?php foreach ($nutrition_plans as $plan): ?>
                    <div class="col-md-4">
                        <div class="card h-100">
                            <img src="path/to/nutrition-image.jpg" class="card-img-top" alt="<?= $plan['name'] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $plan['name'] ?></h5>
                                <p class="card-text">Calories: <?= $plan['calories'] ?>, Protein: <?= $plan['protein'] ?>g, Carbs: <?= $plan['carbs'] ?>g</p>
                                <a href="#" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Profile Section -->
        <section id="profile" class="py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4"><i class="bi bi-person-gear me-2"></i>Profile Settings</h4>
                            <form method="POST">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                                    </div>
                                </div>
                                <button type="submit" name="update_profile" class="btn btn-primary mt-4">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });
        });

        window.addEventListener('scroll', () => {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');
            sections.forEach(section => {
                const rect = section.getBoundingClientRect();
                if (rect.top <= 100 && rect.bottom >= 100) {
                    const id = section.getAttribute('id');
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${id}`) link.classList.add('active');
                    });
                }
            });
        });
    </script>
</body>
</html>