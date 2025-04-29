// Cargamos el video automáticamente al cargar la página
document.addEventListener('DOMContentLoaded', function () {
    const video = document.getElementById('myVideo');

    if (video) {
        // Reproducir el video automáticamente
        video.play().catch(function(error) {
            console.log("Autoplay was prevented:", error);
        });

        // Función para detectar si el video está en el viewport y reproducirlo
        function checkVideoInView() {
            const rect = video.getBoundingClientRect();
            const inView = (
                rect.top >= 0 &&
                rect.left >= 0 &&
                rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                rect.right <= (window.innerWidth || document.documentElement.clientWidth)
            );

            if (inView) {
                video.play().catch(function(error) {
                    console.log("Autoplay was prevented:", error);
                });
            } else {
                video.pause();
            }
        }

        // Escuchar eventos de scroll y resize para verificar si el video está en el viewport
        window.addEventListener('scroll', checkVideoInView);
        window.addEventListener('resize', checkVideoInView);

        // Verificar inicialmente si el video está en el viewport
        checkVideoInView();
    }
});
function validar(formulario) {
    // Verificar si las contraseñas coinciden
    var password = formulario.password.value;
    var confirmPassword = formulario.confirm_password.value;
    
    if (password !== confirmPassword) {
        alert("Las contraseñas no coinciden");
        return false;
    }
    
    // Puedes agregar más validaciones aquí si es necesario
    return true;
}