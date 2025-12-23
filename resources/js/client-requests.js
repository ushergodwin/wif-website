import axios from "axios";
import { showLoader, swalNotification, validateEmail } from "./utils";

const token = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute("content");
axios.defaults.headers.common["X-CSRF-TOKEN"] = token;
export function subscribeToNewsletter(event, form) {
    event.preventDefault();
    // validate email format here if needed
    const email = form.querySelector('input[name="email"]').value;
    if (!validateEmail(email)) {
        swalNotification("error", "Invalid email format.");
        return;
    }
    showLoader("subscribing...");
    const formData = new FormData(form);
    formData.append("_token", token);

    axios
        .post(form.action, formData)
        .then((response) => {
            // Handle success
            if (response.status === 200) {
                swalNotification(
                    "success",
                    "You have successfully subscribed to our newsletter."
                );
                form.reset();
            } else {
                swalNotification(
                    "error",
                    "There was an issue subscribing to the newsletter. Please try again later."
                );
            }
        })
        .catch((error) => {
            // Handle error
            swalNotification(
                "error",
                "There was an issue subscribing to the newsletter. Please try again later."
            );
        });

    return false;
}

// partnership-inquiry-form
export function submitPartnerInquiry(event, form) {
    event.preventDefault();

    const formData = new FormData(form);
    formData.append("_token", token);

    axios
        .post(form.action, formData)
        .then((response) => {
            if (response.status === 200) {
                swalNotification(
                    "success",
                    "Your partnership inquiry has been submitted successfully. We will get back to you soon."
                );
                form.reset();
            } else {
                swalNotification(
                    "error",
                    "There was an issue submitting your inquiry. Please try again later."
                );
            }
        })
        .catch((error) => {
            swalNotification(
                "error",
                "There was an issue submitting your inquiry. Please try again later."
            );
        });

    return false;
}
