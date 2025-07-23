// Sistema de Notificaciones Avanzado
class NotificationSystem {
    constructor() {
        this.notifications = [];
        this.maxNotifications = 5;
        this.defaultDuration = 4000;
        this.init();
    }

    init() {
        // Crear contenedor para notificaciones si no existe
        if (!document.getElementById('notification-container')) {
            const container = document.createElement('div');
            container.id = 'notification-container';
            container.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
                pointer-events: none;
            `;
            document.body.appendChild(container);
        }
    }

    show(message, type = 'info', options = {}) {
        const notification = this.createNotification(message, type, options);
        this.addNotification(notification);
        
        // Auto-remove después del tiempo especificado
        const duration = options.duration || this.defaultDuration;
        if (duration > 0) {
            setTimeout(() => {
                this.remove(notification.id);
            }, duration);
        }

        return notification.id;
    }

    createNotification(message, type, options) {
        const id = 'notification-' + Date.now() + Math.random().toString(36).substr(2, 9);
        const title = options.title || this.getDefaultTitle(type);
        const showProgress = options.showProgress !== false;
        const closable = options.closable !== false;

        const notificationEl = document.createElement('div');
        notificationEl.id = id;
        notificationEl.className = `notification ${type}`;
        notificationEl.style.pointerEvents = 'auto';

        notificationEl.innerHTML = `
            <div class="notification-header">
                <div class="notification-title">${title}</div>
                ${closable ? '<button class="notification-close" onclick="notificationSystem.remove(\'' + id + '\')">&times;</button>' : ''}
            </div>
            <div class="notification-message">${message}</div>
            ${showProgress ? '<div class="notification-progress"></div>' : ''}
        `;

        // Agregar efectos de sonido (opcional)
        if (options.sound !== false) {
            this.playNotificationSound(type);
        }

        return {
            id: id,
            element: notificationEl,
            type: type,
            timestamp: Date.now()
        };
    }

    addNotification(notification) {
        const container = document.getElementById('notification-container');
        
        // Limitar número de notificaciones
        if (this.notifications.length >= this.maxNotifications) {
            this.remove(this.notifications[0].id);
        }

        this.notifications.push(notification);
        container.appendChild(notification.element);

        // Animación de entrada
        requestAnimationFrame(() => {
            notification.element.classList.add('show');
        });

        // Reposicionar notificaciones existentes
        this.repositionNotifications();
    }

    remove(id) {
        const notificationIndex = this.notifications.findIndex(n => n.id === id);
        if (notificationIndex === -1) return;

        const notification = this.notifications[notificationIndex];
        
        // Animación de salida
        notification.element.style.transform = 'translateX(400px)';
        notification.element.style.opacity = '0';

        setTimeout(() => {
            if (notification.element.parentNode) {
                notification.element.parentNode.removeChild(notification.element);
            }
            this.notifications.splice(notificationIndex, 1);
            this.repositionNotifications();
        }, 300);
    }

    repositionNotifications() {
        this.notifications.forEach((notification, index) => {
            const topOffset = 20 + (index * 80);
            notification.element.style.top = `${topOffset}px`;
        });
    }

    getDefaultTitle(type) {
        const titles = {
            success: '¡Éxito!',
            error: 'Error',
            warning: 'Advertencia',
            info: 'Información'
        };
        return titles[type] || 'Notificación';
    }

    playNotificationSound(type) {
        // Sonidos sutiles usando Web Audio API
        if (!window.AudioContext && !window.webkitAudioContext) return;

        const audioContext = new (window.AudioContext || window.webkitAudioContext)();
        const oscillator = audioContext.createOscillator();
        const gainNode = audioContext.createGain();

        oscillator.connect(gainNode);
        gainNode.connect(audioContext.destination);

        const frequencies = {
            success: [523.25, 659.25, 783.99], // C5, E5, G5
            error: [349.23, 293.66], // F4, D4
            warning: [440], // A4
            info: [523.25] // C5
        };

        const freq = frequencies[type] || frequencies.info;
        oscillator.frequency.setValueAtTime(freq[0], audioContext.currentTime);
        
        gainNode.gain.setValueAtTime(0, audioContext.currentTime);
        gainNode.gain.linearRampToValueAtTime(0.1, audioContext.currentTime + 0.01);
        gainNode.gain.exponentialRampToValueAtTime(0.001, audioContext.currentTime + 0.3);

        oscillator.start(audioContext.currentTime);
        oscillator.stop(audioContext.currentTime + 0.3);
    }

    // Métodos de conveniencia
    success(message, options = {}) {
        return this.show(message, 'success', options);
    }

    error(message, options = {}) {
        return this.show(message, 'error', options);
    }

    warning(message, options = {}) {
        return this.show(message, 'warning', options);
    }

    info(message, options = {}) {
        return this.show(message, 'info', options);
    }

    clear() {
        this.notifications.slice().forEach(notification => {
            this.remove(notification.id);
        });
    }
}

// Inicializar sistema global
const notificationSystem = new NotificationSystem();

// Funciones globales para compatibilidad
function showNotification(message, type = 'info', options = {}) {
    return notificationSystem.show(message, type, options);
}

function showSuccess(message, options = {}) {
    return notificationSystem.success(message, options);
}

function showError(message, options = {}) {
    return notificationSystem.error(message, options);
}

function showWarning(message, options = {}) {
    return notificationSystem.warning(message, options);
}

function showInfo(message, options = {}) {
    return notificationSystem.info(message, options);
}

// Auto-inicialización cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        notificationSystem.init();
    });
} else {
    notificationSystem.init();
}

// Manejo de formularios con notificaciones automáticas
document.addEventListener('DOMContentLoaded', function() {
    // Interceptar envío de formularios para mostrar feedback
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const originalSubmit = form.onsubmit;
        
        form.addEventListener('submit', function(e) {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <span class="loading-state">
                        <span class="loading-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        Procesando...
                    </span>
                `;
            }
            
            // Mostrar notificación de carga
            showInfo('Procesando solicitud...', { 
                duration: 0, 
                title: 'Cargando',
                id: 'form-loading'
            });
        });
    });

    // Agregar micro-interacciones a botones
    const buttons = document.querySelectorAll('.btn, button');
    buttons.forEach(button => {
        button.classList.add('micro-interaction');
    });
});
