import "./bootstrap";
import "bootstrap";
import "animate.css";
import { WOW } from "wowjs";
import "./utils";
import { subscribeToNewsletter } from "./client-requests";
// Add any custom JavaScript here
//wow
new WOW().init();
// Initialize tooltips globally
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

// Handle newsletter form submission
const newsletterForm = document.getElementById("join-community-form");
if (newsletterForm) {
    newsletterForm.addEventListener("submit", function (event) {
        subscribeToNewsletter(event, newsletterForm);
    });
}

//handle partnership inquiry form
const partnershipInquiryForm = document.getElementById(
    "partnership-inquiry-form"
);
if (partnershipInquiryForm) {
    partnershipInquiryForm.addEventListener("submit", function (event) {
        submitPartnerInquiry(event, partnershipInquiryForm);
    });
}
