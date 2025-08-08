// Scripts específicos para la gestión de usuarios
function showModal(modalId) {
	document.getElementById(modalId).style.display = 'block';
}

function hideModal(modalId) {
	document.getElementById(modalId).style.display = 'none';
}

function editarUsuario(id) {
	alert('Función de editar usuario ' + id + ' (se implementaría con AJAX o redirección)');
}

function cambiarEstado(id, nuevoEstado) {
	const accion = nuevoEstado === 'true' ? 'activar' : 'desactivar';
	if (confirm(`¿Está seguro de ${accion} este usuario?`)) {
		// Aquí iría la lógica para cambiar el estado
		alert(`Usuario ${accion}do (simulado)`);
	}
}

function eliminarUsuario(id) {
	if (confirm('¿Está seguro de eliminar este usuario? Esta acción no se puede deshacer.')) {
		// Aquí iría la lógica de eliminación
		alert('Usuario eliminado (simulado)');
	}
}

// Validación de contraseñas
document.addEventListener('DOMContentLoaded', function() {
	var form = document.querySelector('form');
	if (form) {
		form.addEventListener('submit', function(e) {
			const password = document.querySelector('input[name="password"]').value;
			const confirmPassword = document.querySelector('input[name="password_confirm"]').value;
			if (password !== confirmPassword) {
				e.preventDefault();
				alert('Las contraseñas no coinciden');
			}
		});
	}
	// Cerrar modal al hacer clic fuera
	window.onclick = function(event) {
		if (event.target.classList && event.target.classList.contains('modal')) {
			event.target.style.display = 'none';
		}
	}
});
