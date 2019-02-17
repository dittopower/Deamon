//Util

//convert distance
function distance(dist,too,from){
var result = 0;
	switch(from){
		case "m":
			result = dist / 0.3048;
			break;
		case "cm":
			result = dist / 30.48;
			break;
		case "in":
			result = dist / 12;
			break;
		default:
			result = dist;
		}
	switch(too){
		case "m":
			result *= 0.3048;
			break;
		case "cm":
			result *= 30.48;
			break;
		case "in":
			result *= 12;
			break;
		}
	return result;
}

//convert weight
function weight(dist,too,from){
var result = 0;
	switch(from){
		case "kg":
			result = dist / 0.453592;
			break;
		case "g":
			result = dist / 453.592;
			break;
		default:
			result = dist;
		}
	switch(too){
		case "kg":
			result *= 0.453592;
			break;
		case "g":
			result *= 453.592;
			break;
		}
	return result;
}

String.prototype.UCfirst = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}

