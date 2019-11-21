/*global fetch*/
/*global DOMPurify*/

String.prototype.capitalize = function() {
    return this.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
};

window.onload = function(){
	const lookup = document.querySelector('#lookup');
	const clookup = document.querySelector('#clookup');
	const result = document.getElementById('result');
	const inputField = document.querySelector('#country');
	const url = "/world.php";
	const countryParam = '?country=';
	const contextParam = '&context=';
	lookup.onclick = function(){
		const input = DOMPurify.sanitize(inputField.value, {SAFE_FOR_TEMPLATES: true});
		const endpoint = url+countryParam+input.capitalize();
		fetch(endpoint).then(res => res.text()).then(data => result.innerHTML = data);
	};
	clookup.onclick = function(){
		const input = DOMPurify.sanitize(inputField.value, {SAFE_FOR_TEMPLATES: true});
		const endpoint = url+countryParam+input.capitalize()+contextParam+"cities";
		fetch(endpoint).then(res => res.text()).then(data => result.innerHTML = data);
	};
};