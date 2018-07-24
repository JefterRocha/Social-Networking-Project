document.querySelector('textarea').addEventListener('keyup', () => {
	document.querySelector('textarea').style.cssText = 'height:auto;'
	document.querySelector('textarea').style.cssText = 'height:' + document.querySelector('textarea').scrollHeight + 'px'
})

document.querySelector('.exit').addEventListener('click', () => {
	window.location = 'exit.php'
})

const submitener = (myfield, e) => {
	var keycode
	if (window.event) keycode = window.event.keyCode
	else if (e) keycode = e.which
	else return true

	if (keycode == 13) {
		if(myfield.value != 0){
			myfield.form.submit()
			return false
		}
		
	} else
		return true
}