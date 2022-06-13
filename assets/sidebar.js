const url = window.location.href;
console.log(url);
if (url.includes("employeeManagement")) {
	let element = document.getElementById("side-select");
	element.classList.add("active");
} else if (url.includes("index.php")) {
	element = document.getElementById("dashboard");
	element.classList.add("side-menu--active");
}
