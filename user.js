document.addEventListener("DOMContentLoaded", () => {
  const registroForm = document.getElementById("registroForm");

  if (registroForm) {
    registroForm.addEventListener("submit", function (event) {
      event.preventDefault();

      const nombre = document.getElementById("nombre").value.trim();
      const correo = document.getElementById("correo").value.trim();
      const password = document.getElementById("password").value;
      const password2 = document.getElementById("password2").value;

      if (password !== password2) {
        alert("Las contraseñas no coinciden.");
        return;
      }

      const datos = { nombre, correo, password };

      fetch("registro.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(datos),
      })
        .then((response) => response.json())
        .then((data) => {
          alert(data.message);
          if (data.success) {
            window.location.href = "login.html";
          }
        })
        .catch((error) => {
          console.error("Error en la conexión:", error);
          alert("Error en la conexión.");
        });
    });
  }
});
