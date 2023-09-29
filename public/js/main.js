function createThumbnail(file, previewElement, errorElement) {
    if (file.type.match('image/jpeg') && file.size <= 30720) { // Max 30KB and JPG format
        var reader = new FileReader();
        reader.onload = function (event) {
            var img = new Image();
            img.src = event.target.result;
            img.classList.add("thumbnail");
            var container = document.createElement("div");
            container.classList.add("thumbnail-container", "m-2");
            container.appendChild(img);

            // Create a remove button
            var removeButton = document.createElement("span");
            removeButton.innerHTML = "&times;";
            removeButton.classList.add("remove-button");
            removeButton.addEventListener("click", function () {
                container.remove();
            });
            container.appendChild(removeButton);

            previewElement.appendChild(container);
        }
        reader.readAsDataURL(file);
    } else {
        errorElement.innerHTML = "Image must be in JPG format and not exceed 30KB.";
    }
}

function previewImages(input, previewElement, errorElement) {
    var files = input.files;
    previewElement.innerHTML = "";
    errorElement.innerHTML = "";
    if (files) {
        for (var i = 0; i < files.length; i++) {
            createThumbnail(files[i], previewElement, errorElement);
        }
    }
}

document.getElementById('imageUpload').addEventListener('change', function () {
    previewImages(this, document.getElementById('imagePreview'), document.getElementById('imageError'));
});

document.getElementById('imageUploadRequest').addEventListener('change', function () {
    previewImages(this, document.getElementById('imagePreviewRequest'), document.getElementById('imageErrorRequest'));
});
(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $('.navbar').addClass('sticky-top shadow-sm');
        } else {
            $('.navbar').removeClass('sticky-top shadow-sm');
        }
    });
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });


    // Facts counter
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        dots: true,
        loop: true,
        center: true,
        responsive: {
            0:{
                items:1
            },
            576:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });


    // Vendor carousel
    $('.vendor-carousel').owlCarousel({
        loop: true,
        margin: 45,
        dots: false,
        loop: true,
        autoplay: true,
        smartSpeed: 1000,
        responsive: {
            0:{
                items:2
            },
            576:{
                items:4
            },
            768:{
                items:6
            },
            992:{
                items:8
            }
        }
    });
    
})(jQuery);

