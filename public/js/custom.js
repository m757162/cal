document.addEventListener("DOMContentLoaded", function(event) {
   
const showNavbar = (toggleId, navId, bodyId, headerId) =>{
const toggle = document.getElementById(toggleId),
nav = document.getElementById(navId),
bodypd = document.getElementById(bodyId),
headerpd = document.getElementById(headerId)

// Validate that all variables exist
if(toggle && nav && bodypd && headerpd){
toggle.addEventListener('click', ()=>{
// show navbar
nav.classList.toggle('show')
// change icon
toggle.classList.toggle('bx-x')
// add padding to body
bodypd.classList.toggle('body-pd')
// add padding to header
headerpd.classList.toggle('body-pd')
})
}
}

showNavbar('header-toggle','nav-bar','body-pd','header')

/*===== LINK ACTIVE =====*/
const linkColor = document.querySelectorAll('.nav_link')

function colorLink(){
if(linkColor){
linkColor.forEach(l=> l.classList.remove('active'))
this.classList.add('active')
}
}
linkColor.forEach(l=> l.addEventListener('click', colorLink))

 // Your code to run since DOM is loaded and ready
});

$('.moon').click(function(){
    $('body').addClass('dark')
    $('.sun').css('display','block')
    $('.moon').css('display','none')
})
$('.sun').click(function(){
    $('body').removeClass('dark')
    $('.sun').css('display','none')
    $('.moon').css('display','block')
})

$('.nav_link').removeClass('active')
var cls=document.querySelectorAll('.nav_link')
var path=location.href.split('/')

if(path[3] == "addUser"){
    $(cls[1]).addClass('active')
}
else{
    $(cls[0]).addClass('active')
}