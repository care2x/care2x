function validate_value(x, mi, mx) {
	if ((x.value != '') && (isNaN(x.value) || (x.value < 0) || (x.value == 0))) {
		if (!mx)
			x.value = '';
		else
			x.value = mi;
	} else if ((x.value > mx) && (mx > 0)) {
		x.value = mx;
	}
}
function validate_max(x, mi) {
	if ((x.value < mi) && (mi > 0))
		x.value = mi;
}
