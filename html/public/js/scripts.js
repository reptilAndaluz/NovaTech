/*!
* Start Bootstrap - Agency v7.0.12 (https://startbootstrap.com/theme/agency)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-agency/blob/master/LICENSE)
*/
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) {
            return;
        }
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }

    };

    // Shrink the navbar 
    navbarShrink();

    // Shrink the navbar when page is scrolled
    document.addEventListener('scroll', navbarShrink);

    //  Activate Bootstrap scrollspy on the main nav element
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    };

    // Collapse responsive navbar when toggler is visible
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (responsiveNavItem) {
        responsiveNavItem.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

});

// Envío asíncrono y validación del formulario de contacto
window.addEventListener("DOMContentLoaded", () => {
    const contactForm = document.getElementById("contactForm");
    const submitButton = document.getElementById("submitButton");
    const successMessage = document.getElementById("submitSuccessMessage");
    const successText = document.getElementById("submitSuccessText");
    const errorMessage = document.getElementById("submitErrorMessage");
    const errorText = document.getElementById("submitErrorText");
    if (!contactForm) return;

    const resetFieldErrors = () => {
        contactForm.querySelectorAll(".form-control").forEach((field) => {
            field.classList.remove("is-invalid");
            const feedback = field.parentElement?.querySelector(".invalid-feedback");
            if (feedback && feedback.dataset.defaultError) {
                feedback.textContent = feedback.dataset.defaultError;
            }
        });
    };

    contactForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        resetFieldErrors();
        if (successMessage) successMessage.classList.add("d-none");
        if (errorMessage) errorMessage.classList.add("d-none");

        if (!contactForm.checkValidity()) {
            contactForm.classList.add("was-validated");
            return;
        }
        contactForm.classList.remove("was-validated");

        const originalLabel = submitButton ? submitButton.textContent : "";
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.textContent = "Enviando...";
        }

        try {
            const response = await fetch(contactForm.action, {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                },
                body: new FormData(contactForm),
            });

            const data = await response.json().catch(() => ({}));

            if (response.status === 422 && data.errors) {
                Object.entries(data.errors).forEach(([fieldName, messages]) => {
                    const field = contactForm.querySelector(`[name="${fieldName}"]`);
                    if (!field) return;
                    field.classList.add("is-invalid");
                    const feedback = field.parentElement?.querySelector(".invalid-feedback");
                    if (feedback && Array.isArray(messages) && messages.length > 0) {
                        feedback.textContent = messages[0];
                    }
                });
                return;
            }

            if (!response.ok) {
                throw new Error(data.message || "Error al procesar la solicitud.");
            }

            contactForm.reset();
            if (successText && data.message) {
                successText.textContent = data.message;
            }
            if (successMessage) {
                successMessage.classList.remove("d-none");
            }
        } catch (err) {
            if (errorText) {
                errorText.textContent = err.message || "Error de conexión al enviar el formulario.";
            }
            if (errorMessage) {
                errorMessage.classList.remove("d-none");
            }
        } finally {
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.textContent = originalLabel;
            }
        }
    });
});
