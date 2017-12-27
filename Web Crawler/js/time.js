/* =*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*

	#Code{LAB} | Coming Soon Template HTML5 BY afrussel
	@Author		   afrussel
	@Type          Javascript

	TABLE OF CONTENTS
	---------------------------
	
		01. Countdown

=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=*=* */
/* ================================= */
/* ::::::::: 1. Countdown :::::::::: */
/* ================================= */
$('#countdown_dashboard').countDown({
		targetDate: {
			'day': 		30,
			'month': 	12,
			'year': 	2016,
			'hour': 	11,
			'min': 		13,
			'sec': 		0
		},
		omitWeeks: true
});