import "./bootstrap";

import toastr from "toastr";
import "toastr/build/toastr.min.css";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

if (authID & (guard === "admin")) {
    Echo.private("App.Models.Admin." + authID).notification((notification) => {
        alert(notification.msg);
        toastr.success(notification.msg);
    });
} else {
    Echo.private("App.Models.User." + authID).notification((notification) => {
        alert(notification.msg);
        console.log(notification.msg);
        alert("user");
        toastr.success("Have fun storming the castle!", "Miracle Max Says");
    });
}
