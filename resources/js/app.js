require('./bootstrap');
import ScrollReveal from 'scrollreveal'
function logout(event) {
    event.preventDefault();
    document.getElementById('logout-form').submit();
}

new VenoBox({
    selector: '.venobox',
    numeration:true,
    infinigall:true,
    share:true,
    spinner:"rotating-plane"
});

ScrollReveal().reveal('.post',{
    origin: 'top',
    distance:'30px',
    duration:500,
    interval:500
});
