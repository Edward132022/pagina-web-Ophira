/**
 * cookies.js
 * Controla la visibilidad y la expiración del banner de cookies.
 */

(function() {
    const BANNER_ID      = 'cookie-banner';
    const ACCEPT_BTN_ID  = 'accept-cookies';
    const STORAGE_KEY    = 'cookies_accepted';   // Clave en localStorage
    const EXPIRE_DAYS    = 365;                  // Días antes de volver a mostrar
  
    /**
     * Comprueba si la aceptación está almacenada y, en caso afirmativo,
     * si aún no ha expirado.
     */
    function isAccepted() {
      const record = localStorage.getItem(STORAGE_KEY);
      if (!record) return false;
  
      try {
        const { timestamp, days } = JSON.parse(record);
        const now = Date.now();
        // Si ha pasado más tiempo del permitido, considerar expirado
        return (now - timestamp) < days * 24 * 60 * 60 * 1000;
      } catch (e) {
        console.warn('Error leyendo cookies_accepted:', e);
        return false;
      }
    }
  
    /**
     * Guarda la aceptación con fecha y expiración.
     */
    function saveAcceptance() {
      const record = {
        timestamp: Date.now(),
        days: EXPIRE_DAYS
      };
      localStorage.setItem(STORAGE_KEY, JSON.stringify(record));
    }
  
    /**
     * Muestra el banner (flex) o lo oculta (none).
     */
    function setBannerVisibility(show) {
      const banner = document.getElementById(BANNER_ID);
      if (!banner) return;
      banner.style.display = show ? 'flex' : 'none';
    }
  
    // Al cargar la página
    document.addEventListener('DOMContentLoaded', () => {
      // Si no hemos aceptado o expiró, mostramos el banner
      setBannerVisibility(!isAccepted());
  
      // Al hacer clic en “Aceptar”
      const btn = document.getElementById(ACCEPT_BTN_ID);
      btn.addEventListener('click', () => {
        saveAcceptance();
        setBannerVisibility(false);
      });
    });
  })();
  