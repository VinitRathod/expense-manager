const url = window.location.href;
console.log(url);
if (url.includes("employeeManagement")) {
	console.log("employeeManagement");
	let element = document.getElementById("side-select2");
	element.classList.add("active");

// } else if (url.includes("index.php")) {
// 	element = document.getElementById("dashboard");
// 	element.classList.add("side-menu--active");
 }
