// ===================================
// 1. INITIALIZATION
// ===================================
document.addEventListener("DOMContentLoaded", () => {
  // Initialize AOS Animation Library
  if (typeof AOS !== "undefined") {
    AOS.init({
      duration: 800,
      easing: "ease",
      once: true,
      offset: 100,
    });
  }

  // Initialize Lucide icons
  if (typeof lucide !== "undefined") {
    lucide.createIcons();
  }

  // Initialize FAQ Accordion
  initFaqAccordion();

  // Initialize Modal Event Listeners
  initModals();
});

// ===================================
// 2. NAVBAR FUNCTIONALITY
// ===================================
const navbar = document.querySelector(".navbar");
window.addEventListener("scroll", () => {
  navbar.classList.toggle("sticky", window.scrollY > 50);
});

// Mobile Menu Toggle
const menuToggle = document.querySelector(".menu-toggle");
const navMenu = document.querySelector(".nav-menu");
if (menuToggle && navMenu) {
  menuToggle.addEventListener("click", () => {
    menuToggle.classList.toggle("active");
    navMenu.classList.toggle("active");
    document.body.classList.toggle("no-scroll");
  });

  // Close menu when clicking outside
  document.addEventListener("click", (e) => {
    if (!menuToggle.contains(e.target) && !navMenu.contains(e.target)) {
      menuToggle.classList.remove("active");
      navMenu.classList.remove("active");
      document.body.classList.remove("no-scroll");
    }
  });
}

// Replace your existing modal handling code with this
// ===================================
// 3. MODAL FUNCTIONALITY (FIXED)
// ===================================
function initModals() {
  // Cleanup multiple backdrops
  document.addEventListener('show.bs.modal', () => {
    document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
  });

  // Proper modal switching
  document.querySelectorAll('[data-bs-toggle="modal"]').forEach(trigger => {
    trigger.addEventListener('click', function(e) {
      const targetModal = document.querySelector(this.dataset.bsTarget);
      const currentModal = bootstrap.Modal.getInstance(targetModal);
      
      // Hide all other modals
      document.querySelectorAll('.modal').forEach(modal => {
        if (modal !== targetModal) {
          bootstrap.Modal.getInstance(modal)?.hide();
        }
      });

      currentModal?.show();
    });
  });
}

// Initialize Bootstrap modals properly
document.addEventListener('DOMContentLoaded', () => {
  const modals = document.querySelectorAll('.modal');
  modals.forEach(modal => {
    modal.addEventListener('hidden.bs.modal', () => {
      document.querySelectorAll('.modal-backdrop').forEach(backdrop => backdrop.remove());
    });
  });
});
// ===================================
// 4. BACK TO TOP BUTTON
// ===================================
const backToTopBtn = document.querySelector(".back-to-top");
window.addEventListener("scroll", () => {
  backToTopBtn.classList.toggle("active", window.scrollY > 300);
});

backToTopBtn.addEventListener("click", (e) => {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: "smooth" });
});

// ===================================
// 5. TESTIMONIAL SLIDER
// ===================================
let currentSlide = 0;
const testimonialSlides = document.querySelectorAll(".testimonial-slide");
const dots = document.querySelectorAll(".dot");

function showSlide(index) {
  testimonialSlides.forEach((slide) => slide.classList.remove("active"));
  dots.forEach((dot) => dot.classList.remove("active"));
  
  testimonialSlides[index].classList.add("active");
  dots[index].classList.add("active");
  currentSlide = index;
}

if (testimonialSlides.length > 0) {
  // Initialize testimonial slider
  showSlide(0);

  // Click event for dots
  dots.forEach((dot, index) => {
    dot.addEventListener("click", () => showSlide(index));
  });

  // Auto slide change
  setInterval(() => {
    currentSlide = (currentSlide + 1) % testimonialSlides.length;
    showSlide(currentSlide);
  }, 5000);
}

// ===================================
// 6. FAQ ACCORDION
// ===================================
function initFaqAccordion() {
  const faqQuestions = document.querySelectorAll(".faq-question");

  faqQuestions.forEach((question) => {
    question.addEventListener("click", function() {
      const answer = this.nextElementSibling;
      const isActive = this.classList.contains("active");

      // Close all FAQs
      faqQuestions.forEach((q) => {
        q.classList.remove("active");
        q.nextElementSibling.classList.remove("active");
      });

      // Toggle current if not active
      if (!isActive) {
        this.classList.add("active");
        answer.classList.add("active");
      }
    });
  });
}

// ===================================
// 7. FORM HANDLING
// ===================================
// Contact Form
const contactForm = document.getElementById("contactForm");
if (contactForm) {
  contactForm.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Thank you for your message! We will get back to you soon.");
    contactForm.reset();
  });
}

// Newsletter Form
const newsletterForm = document.querySelector(".newsletter-form");
if (newsletterForm) {
  newsletterForm.addEventListener("submit", (e) => {
    e.preventDefault();
    alert("Thank you for subscribing to our newsletter!");
    newsletterForm.reset();
  });
}

// ===================================
// 8. SMOOTH SCROLLING
// ===================================
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener("click", function(e) {
    if (this.hash !== "") {
      e.preventDefault();
      const target = document.querySelector(this.hash);
      if (target) {
        window.scrollTo({
          top: target.offsetTop - 80,
          behavior: "smooth"
        });
      }
    }
  });
});

// // Add this to your script.js file
// document.addEventListener('DOMContentLoaded', function() {
//   // Fix multiple backdrop issue
//   document.addEventListener('show.bs.modal', function(e) {
//       // Clear existing backdrops
//       const existingBackdrops = document.querySelectorAll('.modal-backdrop');
//       existingBackdrops.forEach(backdrop => backdrop.remove());
      
//       // Close any other open modals
//       const openModals = document.querySelectorAll('.modal.show');
//       openModals.forEach(modal => {
//           const bsModal = bootstrap.Modal.getInstance(modal);
//           if (bsModal) bsModal.hide();
//       });
//   });

//   // Improve modal transitions
//   document.addEventListener('hidden.bs.modal', function(e) {
//       // Ensure backdrop is removed after animation
//       const existingBackdrops = document.querySelectorAll('.modal-backdrop');
//       existingBackdrops.forEach(backdrop => backdrop.remove());
//   });
// });