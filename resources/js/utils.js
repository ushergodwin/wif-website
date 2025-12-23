import axios from "axios";
import Swal from "sweetalert2";

axios.defaults.withCredentials = false;

// axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute("content");
axios.defaults.headers.common["X-CSRF-TOKEN"] = token;
export function getDownloadedFile(blob, filename) {
    const url = window.URL.createObjectURL(blob);
    const link = document.createElement("a");
    link.href = url;
    link.setAttribute("download", filename);
    link.style.display = "none";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    window.URL.revokeObjectURL(url);
}
export const RequestHelper = {
    getRequest: (action, params = {}, token = "") => {
        return axios.get(action, {
            params,
            headers: {
                Accept: "application/json",
                Authorization: `Bearer ${token}`,
            },
            // withCredentials: true,
        });
    },
    downloadFile: (action, params = {}, token = "") => {
        return axios.get(action, {
            params,
            responseType: "blob",
            headers: {
                Accept: "application/json",
                Authorization: `Bearer ${token}`,
            },
            // withCredentials: true,
        });
    },

    getUser: (action = "/api/user", params = {}, token = "") => {
        return axios.get(action, {
            params,
            headers: {
                Accept: "application/json",
                Authorization: `Bearer ${token}`,
            },
            // withCredentials: true,
        });
    },

    postRequest: (action, formData, params = {}) => {
        formData.append("_token", token);
        return axios.post(action, formData, {
            params,
            headers: {
                Accept: "application/json",
                "Content-Type":
                    "multipart/form-data; charset=utf-8; boundary=" +
                    Math.random().toString().substr(2),
                Authorization: `Bearer ${token}`,
            },
            // withCredentials: true,
        });
    },

    deleteRequest: (action, params = {}, token = "") => {
        return axios.delete(action, {
            params,
            headers: {
                Accept: "application/json",
                Authorization: `Bearer ${token}`,
            },
            // withCredentials: true,
        });
    },
};

export const formatters = {
    numerilize: (n, t, d) => {
        if (typeof t === undefined || t == null) {
            if (typeof n === "number" || typeof n === "string") {
                if (n > 1000000000000)
                    return (n / 1000000000000).toFixed(d) + " Tn";
                else if (n > 1000000000)
                    return (n / 1000000000).toFixed(d) + " Bn";
                else if (n > 1000000) return (n / 1000000).toFixed(d) + " M";
                else if (n > 1000) return (n / 1000).toFixed(d) + " K";
                return n;
            } else {
                return n;
            }
        } else {
            var num = !isFinite(+n) ? 0 : +n,
                prec = !isFinite(+d) ? 0 : Math.abs(d),
                sep = ",",
                dec = ".",
                toFixedFix = function (num, prec) {
                    var k = Math.pow(10, prec);
                    return Math.round(num * k) / k;
                },
                s = (prec ? toFixedFix(num, prec) : Math.round(num))
                    .toString()
                    .split(".");
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || "").length < prec) {
                s[1] = s[1] || "";
                s[1] += new Array(prec - s[1].length + 1).join("0");
            }
            return s.join(dec);
        }
    },
    formatCurrency: (inputCurrency) => {
        return new Intl.NumberFormat("en-US").format(inputCurrency);
    },
    cleanOutSpecialCharacters: (oldVal = "") => {
        return oldVal
            .replace(/[^a-zA-Z0-9\s]/g, "")
            .replace(/\s+/g, "_")
            .toLowerCase();
    },
};

export function getUserRoles() {
    return RequestHelper.getRequest("/api/user-role");
}

export function swalNotification(icon, message, timer = 2000) {
    Swal.close();
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
        },
        buttonsStyling: false,
    });
    return swalWithBootstrapButtons.fire({
        icon,
        html: message,
    });
}

export function showLoader(text = "loading, please wait..", close = false) {
    Swal.close();
    if (close) {
        Swal.close();
        return;
    }

    Swal.fire({
        html: `<p style='fontsize:16px'>${text}</p>`,
        didOpen: () => {
            Swal.showLoading();
        },
        allowOutsideClick: false,
    });
}
// export default formatters;

// export default RequestHelper;
export function formatWithCommas(num) {
    if (typeof num !== "number" || isNaN(num)) {
        throw new Error("Input must be a valid number");
    }
    return num.toLocaleString(); // Uses system locale (e.g., "1,234,567")
}

export const formatShortNumber = (num) => {
    if (num >= 1_000_000_000) return (num / 1_000_000_000).toFixed(1) + "B";
    if (num >= 1_000_000) return (num / 1_000_000).toFixed(1) + "M";
    if (num >= 1_000) return (num / 1_000).toFixed(1) + "K";
    return num.toString();
};

export function validateEmail(email) {
    const re =
        /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@(([^<>()[\]\.,;:\s@"]+\.)+[^<>()[\]\.,;:\s@"]{2,})$/i;
    return re.test(String(email).toLowerCase());
}
