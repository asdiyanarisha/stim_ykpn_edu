/* ============================================
   STIM YKPN Redesign — Interactive Scripts
   ============================================ */

document.addEventListener('DOMContentLoaded', () => {
  initNavbar();
  initHeroSlider();
  initScrollAnimations();
  initCounterAnimation();
  initTestimonialSlider();
  initSmoothScroll();
  initMobileNav();
  initFacultyFilter();
  initWhatsApp();
  initLiveSearch();
});

/* --- Navbar Scroll Effect --- */
function initNavbar() {
  const navbar = document.getElementById('navbar');
  let lastScroll = 0;

  window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;

    if (currentScroll > 60) {
      navbar.classList.add('scrolled');
    } else {
      navbar.classList.remove('scrolled');
    }

    lastScroll = currentScroll;
  }, { passive: true });
}

/* --- Hero Slider --- */
function initHeroSlider() {
  const slides = document.querySelectorAll('.hero-slider .slide');
  const dots = document.querySelectorAll('#heroSliderDots .dot');
  const prevBtn = document.getElementById('heroPrevBtn');
  const nextBtn = document.getElementById('heroNextBtn');
  let currentSlide = 0;
  let slideInterval;

  if (slides.length === 0) return;

  function showSlide(index) {
    slides.forEach(slide => slide.classList.remove('active'));
    dots.forEach(dot => dot.classList.remove('active'));

    slides[index].classList.add('active');
    dots[index].classList.add('active');
    currentSlide = index;

    // Show hero text only on first slide unless data-always-visible is set
    const heroContent = document.querySelector('.hero-content');
    if (heroContent) {
      if (index === 0 || heroContent.hasAttribute('data-always-visible')) {
        heroContent.style.opacity = '1';
        heroContent.style.transform = 'translateY(0)';
        heroContent.style.pointerEvents = 'auto';
      } else {
        heroContent.style.opacity = '0';
        heroContent.style.transform = 'translateY(20px)';
        heroContent.style.pointerEvents = 'none';
      }
    }
  }

  function nextSlide() {
    let next = currentSlide + 1;
    if (next >= slides.length) next = 0;
    showSlide(next);
  }

  function prevSlide() {
    let prev = currentSlide - 1;
    if (prev < 0) prev = slides.length - 1;
    showSlide(prev);
  }

  function resetInterval() {
    clearInterval(slideInterval);
    slideInterval = setInterval(nextSlide, 6000);
  }

  // Event Listeners
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      nextSlide();
      resetInterval();
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      prevSlide();
      resetInterval();
    });
  }

  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      const index = parseInt(dot.getAttribute('data-index'));
      showSlide(index);
      resetInterval();
    });
  });

  // Start autoplay
  resetInterval();
}

/* --- Scroll Animations (Intersection Observer) --- */
function initScrollAnimations() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -60px 0px'
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('is-visible');
        observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  document.querySelectorAll('.animate-on-scroll').forEach(el => {
    observer.observe(el);
  });
}

/* --- Counter Animation --- */
function initCounterAnimation() {
  const counters = document.querySelectorAll('[data-count]');

  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });

  counters.forEach(counter => counterObserver.observe(counter));
}

function animateCounter(element) {
  const target = parseInt(element.dataset.count);
  const suffix = element.dataset.suffix || '';
  const duration = 2000;
  const start = performance.now();

  function update(currentTime) {
    const elapsed = currentTime - start;
    const progress = Math.min(elapsed / duration, 1);

    // Ease-out cubic
    const eased = 1 - Math.pow(1 - progress, 3);
    const current = Math.round(eased * target);

    if (target >= 1000) {
      element.textContent = current.toLocaleString('id-ID') + suffix;
    } else {
      element.textContent = current + suffix;
    }

    if (progress < 1) {
      requestAnimationFrame(update);
    }
  }

  requestAnimationFrame(update);
}

/* --- Testimonial Slider --- */
function initTestimonialSlider() {
  const testimonials = window.dynamicTestimonials || [
    {
      text: 'Kuliah di STIM YKPN memberi saya banyak pengalaman berharga. Dengan dukungan dosen dan bekal ilmu manajemen yang kuat, saya dapat menerapkannya langsung dalam pekerjaan saya sebagai Regional Manager ERIGO.',
      name: 'Agil Yudha Aryakusuma, S.M.',
      role: 'Regional Manager',
      company: 'PT Idea Solusi Indonesia (ERIGO)',
      initials: 'AY'
    },
    {
      text: 'Selama kuliah di STIM YKPN, saya mendapat ilmu akademik dan pengalaman organisasi. Aktif di UKM Futsal mengasah kerja sama tim, kepemimpinan, dan disiplin. STIM YKPN bukan sekadar tempat belajar, tapi juga tempat bertumbuh.',
      name: 'Muhammad Fajrin, S.M.',
      role: 'Operator Processing & Metallurgy',
      company: 'PT. PAMA PERSADA',
      initials: 'MF'
    },
    {
      text: 'Puji Tuhan, saya bangga menjadi lulusan STIM YKPN Yogyakarta. Didikan dari dosen yang kompeten membuat saya siap kerja. Saya magang di Bank NTT, dan setelah lulus langsung diterima bekerja di sana.',
      name: 'Ercy Rambu Ata',
      role: 'Staff Perbankan',
      company: 'Bank NTT Cabang Waibakul',
      initials: 'ER'
    },
    {
      text: 'STIM YKPN membentuk saya menjadi pribadi unggul dan memiliki daya saing di dunia kerja. Lingkungan di STIM YKPN sangat positif untuk menuntut ilmu. Semoga STIM YKPN semakin jaya!',
      name: 'Evianti',
      role: 'General Affair',
      company: 'PT Bank Mandiri Taspen Palu',
      initials: 'EV'
    },
    {
      text: 'Mata kuliah Pasar Modal di STIM YKPN membantu saya menemukan minat dalam mengelola instrumen investasi hingga saat ini bekerja di perusahaan sekuritas.',
      name: 'Galih Sukma Ramadhan, S.M.',
      role: 'Investment Specialist',
      company: 'PT. Mirae Asset Sekuritas',
      initials: 'GS'
    }
  ];

  let currentIndex = 0;
  let autoPlayInterval;

  const quoteText = document.getElementById('quoteText');
  const alumniName = document.getElementById('alumniName');
  const alumniRole = document.getElementById('alumniRole');
  const alumniCompany = document.getElementById('alumniCompany');
  const alumniAvatar = document.getElementById('alumniAvatar');
  const dots = document.querySelectorAll('.testimonial-dots .dot');
  const card = document.getElementById('testimonialCard');

  if (!card) return;

  function showTestimonial(index) {
    // Fade out
    card.style.opacity = '0';
    card.style.transform = 'translateY(10px)';

    setTimeout(() => {
      const t = testimonials[index];
      quoteText.textContent = t.text;
      alumniName.textContent = t.name;
      alumniRole.textContent = t.role;
      alumniCompany.textContent = t.company;
      alumniAvatar.textContent = t.initials;

      // Update dots
      dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
      });

      // Fade in
      card.style.opacity = '1';
      card.style.transform = 'translateY(0)';
    }, 300);

    currentIndex = index;
  }

  // Add transition styles
  card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';

  // Dot clicks
  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      const index = parseInt(dot.dataset.index);
      showTestimonial(index);
      resetAutoPlay();
    });
  });

  // Auto-play
  function startAutoPlay() {
    autoPlayInterval = setInterval(() => {
      const nextIndex = (currentIndex + 1) % testimonials.length;
      showTestimonial(nextIndex);
    }, 5000);
  }

  function resetAutoPlay() {
    clearInterval(autoPlayInterval);
    startAutoPlay();
  }

  startAutoPlay();
}

/* --- Smooth Scroll --- */
function initSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener('click', (e) => {
      const targetId = link.getAttribute('href');
      if (targetId === '#') return;

      const target = document.querySelector(targetId);
      if (target) {
        e.preventDefault();

        // Close mobile nav if open
        const navLinks = document.getElementById('navLinks');
        const navToggle = document.getElementById('navToggle');
        navLinks.classList.remove('active');
        navToggle.classList.remove('active');

        const navHeight = document.getElementById('navbar').offsetHeight;
        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navHeight;

        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });

        // Update active nav link
        document.querySelectorAll('.nav-links a').forEach(a => a.classList.remove('active'));
        link.classList.add('active');
      }
    });
  });

  // Update active on scroll
  const sections = document.querySelectorAll('section[id]');
  window.addEventListener('scroll', () => {
    const scrollY = window.pageYOffset;
    const navHeight = document.getElementById('navbar').offsetHeight;

    sections.forEach(section => {
      const sectionTop = section.offsetTop - navHeight - 100;
      const sectionHeight = section.offsetHeight;
      const sectionId = section.getAttribute('id');

      if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
        document.querySelectorAll('.nav-links a').forEach(a => {
          a.classList.remove('active');
          if (a.getAttribute('href') === `#${sectionId}`) {
            a.classList.add('active');
          }
        });
      }
    });
  }, { passive: true });
}

/* --- Mobile Navigation --- */
function initMobileNav() {
  const mobileOverlay = document.getElementById('mobileOverlay');
  const navToggle = document.getElementById('navToggle');
  const closeMenu = document.getElementById('closeMenu');

  if (navToggle && mobileOverlay) {
    navToggle.addEventListener('click', (e) => {
      e.preventDefault();
      mobileOverlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    });
  }

  if (closeMenu && mobileOverlay) {
    closeMenu.addEventListener('click', () => {
      mobileOverlay.classList.remove('active');
      document.body.style.overflow = '';
    });
  }

  // Close menu on link click
  const mobileLinks = document.querySelectorAll('.mobile-nav-item:not(.has-submenu)');
  mobileLinks.forEach(link => {
    link.addEventListener('click', () => {
      mobileOverlay.classList.remove('active');
      document.body.style.overflow = '';
    });
  });

  // Submenu Accordion Toggle
  const submenuToggles = document.querySelectorAll('.mobile-nav-item.has-submenu');
  submenuToggles.forEach(toggle => {
    toggle.addEventListener('click', () => {
      const group = toggle.parentElement;
      // Allow multiple to be open by not removing 'active' from other groups
      group.classList.toggle('active');
    });
  });
}

/* --- Live Search Utility --- */
function initLiveSearch() {
  const searchInputs = document.querySelectorAll('[data-search-target]');
  
  searchInputs.forEach(input => {
    const targetSelector = input.getAttribute('data-search-target');
    const itemsSelector = input.getAttribute('data-search-items');
    
    input.addEventListener('input', (e) => {
      const term = e.target.value.toLowerCase();
      const items = document.querySelectorAll(`${targetSelector} ${itemsSelector}`);
      
      items.forEach(item => {
        const text = item.innerText.toLowerCase();
        if (text.includes(term)) {
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
}

/* --- Faculty Filter --- */
function initFacultyFilter() {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const facultyCards = document.querySelectorAll('.faculty-card');
  const searchInput = document.getElementById('facultySearch');

  if (filterBtns.length === 0 && !searchInput) return;

  let activeFilter = 'all';
  let searchTerm = '';

  function applyFilters() {
    facultyCards.forEach(card => {
      const category = card.getAttribute('data-category');
      const name = card.querySelector('.faculty-name')?.innerText.toLowerCase() || '';
      const expertise = card.querySelector('.faculty-expertise')?.innerText.toLowerCase() || '';
      const role = card.querySelector('.faculty-role')?.innerText.toLowerCase() || '';
      
      const fullText = `${name} ${expertise} ${role}`;
      
      const matchesCategory = activeFilter === 'all' || category === activeFilter;
      const matchesSearch = fullText.includes(searchTerm);

      if (matchesCategory && matchesSearch) {
        if (card.style.display === 'none') {
          card.style.display = 'block';
          card.style.animation = 'scaleIn 0.4s ease forwards';
        }
      } else {
        card.style.display = 'none';
      }
    });
  }

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      activeFilter = btn.getAttribute('data-filter');
      applyFilters();
    });
  });

  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      searchTerm = e.target.value.toLowerCase();
      applyFilters();
    });
  }
}

/* --- WhatsApp Widget --- */
function initWhatsApp() {
  const toggleBtn = document.getElementById('waToggleBtn');
  const closeBtn = document.getElementById('waCloseBtn');
  const popup = document.getElementById('waPopup');

  if(toggleBtn && popup) {
    toggleBtn.addEventListener('click', () => {
      popup.classList.toggle('active');
    });

    if(closeBtn) {
      closeBtn.addEventListener('click', () => {
        popup.classList.remove('active');
      });
    }

    // Close when clicking outside
    document.addEventListener('click', (e) => {
      if (!toggleBtn.contains(e.target) && !popup.contains(e.target) && popup.classList.contains('active')) {
        popup.classList.remove('active');
      }
    });
  }
}


// --- Video Modal Logic ---
document.addEventListener('DOMContentLoaded', () => {
  const playBtn = document.getElementById('playButton');
  const modal = document.getElementById('videoModal');
  if (playBtn && modal) {
    const closeBtn = document.getElementById('videoModalClose');
    const overlay = document.getElementById('videoModalOverlay');
    const iframeWrapper = modal.querySelector('.video-iframe-wrapper');
    const videoUrl = 'https://www.youtube.com/embed/miUW4EkRWN8?autoplay=1';

    function openModal() {
      iframeWrapper.innerHTML = `<iframe width="100%" height="100%" src="${videoUrl}" title="Campus Tour STIM YKPN" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>`;
      modal.classList.add('active');
    }

    function closeModal() {
      modal.classList.remove('active');
      setTimeout(() => { iframeWrapper.innerHTML = ''; }, 300); // Stop video playing after fade out
    }

    playBtn.addEventListener('click', openModal);
    closeBtn.addEventListener('click', closeModal);
    overlay.addEventListener('click', closeModal);
  }
});