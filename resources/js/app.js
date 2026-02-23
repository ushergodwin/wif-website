import "./bootstrap";
import "bootstrap";
import "animate.css";
import "./utils";
// Add any custom JavaScript here
// Initialize tooltips globally
var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});
