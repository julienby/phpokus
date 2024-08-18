document.addEventListener("DOMContentLoaded", function() {
    console.log("Page chargée !");
    
    const button = document.getElementById('alertButton');
    if (button) {
        button.addEventListener('click', function() {
            alert("Button clicked!");
        });
    }
});

