/*
 * Bones Scripts File
 * Author: Eddie Machado
 *
 * This file should contain any js scripts you want to add to the site.
 * Instead of calling it in the header or throwing it inside wp_head()
 * this file will be called automatically in the footer so as not to
 * slow the page load.
 *
 * There are a lot of example functions and tools in here. If you don't
 * need any of it, just remove it. They are meant to be helpers and are
 * not required. It's your world baby, you can do whatever you want.
 */

/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
 */
function updateViewportDimensions() {
  var w = window,
    d = document,
    e = d.documentElement,
    g = d.getElementsByTagName("body")[0],
    x = w.innerWidth || e.clientWidth || g.clientWidth,
    y = w.innerHeight || e.clientHeight || g.clientHeight;
  return { width: x, height: y };
}
// setting the viewport width
var viewport = updateViewportDimensions();

/*
 * Throttle Resize-triggered Events
 * Wrap your actions in this function to throttle the frequency of firing them off, for better performance, esp. on mobile.
 * ( source: http://stackoverflow.com/questions/2854407/javascript-jquery-window-resize-how-to-fire-after-the-resize-is-completed )
 */
var waitForFinalEvent = (function() {
  var timers = {};
  return function(callback, ms, uniqueId) {
    if (!uniqueId) {
      uniqueId = "Don't call this twice without a uniqueId";
    }
    if (timers[uniqueId]) {
      clearTimeout(timers[uniqueId]);
    }
    timers[uniqueId] = setTimeout(callback, ms);
  };
})();

// how long to wait before deciding the resize has stopped, in ms. Around 50-100 should work ok.
var timeToWaitForLast = 100;

// Alertas dummy content
var dummyAlertas = [
  {
    id: "4",
    autor_id: "4",
    nivel: "aviso",
    titulo: "Puesta en marcha de la caldera auxiliar de Profertil",
    contenido:
      "Profertil informa a la comunidad que la puesta en marcha de su caldera auxiliar se re progamó para la madrugada del día 15 de junio. Motivo por el cual se podrá percibir un incremento en el nivel sonoro. Recordamos que esta es una tarea que forma parte de la secuencia de acciones preparativas para la puesta en marcha, una vez que se finalicen las actividades relativas a la parada de planta.",
    fecha_publicacion: "2018-06-14 23:00:15",
    updated_at: "2018-06-14 23:01:02",
    fecha_fin: "2018-06-17 22:56:00"
  },
  {
    id: "8",
    autor_id: "3",
    nivel: "aviso",
    titulo: "Corte en Avenida Dasso",
    contenido:
      "La Delegación Municipal de Ingeniero White informa a la comunidad que la Avenida Dasso permanecerá cortada el día de hoy, aproximadamente hasta las 16hs. a la altura de Daniel De Solier por tareas de pavimentación.",
    fecha_publicacion: "2018-06-29 15:17:30",
    updated_at: "2018-06-29 15:17:30",
    fecha_fin: "2018-06-29 16:00:00"
  },
  {
    id: "10",
    autor_id: "3",
    nivel: "urgente",
    titulo:
      "Traslado de aerogeneradores hacia Villalonga el día de mañana, (aviso de tránsito)",
    contenido:
      "La Dirección de Control de Tránsito informó que el lunes a las 10.30 comenzarán los operativos de traslado de aerogeneradores desde el puerto local, por ruta 3, hacia el Parque Eólico Villalonga. Por tratarse de vehículos de grandes dimensiones, se solicita a los conductores que transiten por la ruta en el horario señalado extrema precaución y respetar señales de advertencia.  La obra, a cargo de la empresa Genneia, se desarrolla en una superficie de 700 hectáreas sobre Ruta Nacional 3, a 90 kilómetros de Carmen de Patagones. El Parque Eólico Villalonga prevé inyectar al sistema interconectado nacional alrededor de 50Mw.",
    fecha_publicacion: "2018-07-01 21:04:50",
    updated_at: "2018-07-01 21:04:50",
    fecha_fin: "2018-07-02 15:00:00"
  },
  {
    id: "14",
    autor_id: "3",
    nivel: "importante",
    titulo: "Corte de agua en Ingeniero White",
    contenido:
      "El mismo se debe a una rotura en el caño principal que pasa por calle Velez Sarsfield y Belgrano. La contratista está trabajando en el lugar.",
    fecha_publicacion: "2018-07-15 20:11:03",
    updated_at: "2018-07-15 20:11:03",
    fecha_fin: "2018-07-16 09:00:00"
  },
  {
    id: "31",
    autor_id: "4",
    nivel: "aviso",
    titulo: "PROFERTIL informa a sus vecinos y a la comunidad",
    contenido:
      "Ingeniero White, 4 de septiembre. La compañía informa que ha iniciado las maniobras para sacar de servicio su planta de producción de urea del complejo de Cangrejales, a fin de realizar tareas de acondicionamiento eléctrico en dicha planta. Estimando normalizar la operación del proceso productivo en las próximas  24 hs.\r\nEn el curso de estas acciones podría observarse mayor luminosidad en las antorchas de proceso y, eventual y esporádicamente, un incremento del nivel sonoro habitual. \r\nLas autoridades municipales, provinciales y nacionales están debidamente informadas como es habitual en estas maniobras.",
    fecha_publicacion: "2018-09-04 10:54:04",
    updated_at: "2018-09-04 10:54:04",
    fecha_fin: "2018-09-09 10:52:00"
  },
  {
    id: "49",
    autor_id: "3",
    nivel: "importante",
    titulo: "Aviso Meteorológico a muy corto plazo N° 1070",
    contenido:
      "Para  - Bahía Blanca - Ingeniero White - A. Gonzales Chaves- Cnel. Dorrego - Cnel. Suarez - Cnel. Pringles - Gral Lamadrid - Puan - Saavedra - San Cayetano – Tornquist por tormentas fuertes con ráfagas y caída de granizo.\r\nFuente: SMN.",
    fecha_publicacion: "2018-11-09 16:04:32",
    updated_at: "2018-11-09 16:04:32",
    fecha_fin: "2018-11-09 21:01:00"
  },
  {
    id: "70",
    autor_id: "6",
    nivel: "urgente",
    titulo: "Explosión",
    contenido:
      "Se informa a la comunidad que en la planta LHC2 hubo una explosión, no hay heridos. Se decreta PRET Nivel 1 ALERTA",
    fecha_publicacion: "2019-06-28 01:08:17",
    updated_at: "2019-06-28 01:08:17",
    fecha_fin: "2019-06-29 01:04:00"
  }
];

/*
 * Here's an example so you can see how we're using the above function
 *
 * This is commented out so it won't work, but you can copy it and
 * remove the comments.
 *
 *
 *
 * If we want to only do it on a certain page, we can setup checks so we do it
 * as efficient as possible.
 *
 * if( typeof is_home === "undefined" ) var is_home = $('body').hasClass('home');
 *
 * This once checks to see if you're on the home page based on the body class
 * We can then use that check to perform actions on the home page only
 *
 * When the window is resized, we perform this function
 * $(window).resize(function () {
 *
 *    // if we're on the home page, we wait the set amount (in function above) then fire the function
 *    if( is_home ) { waitForFinalEvent( function() {
 *
 *      // if we're above or equal to 768 fire this off
 *      if( viewport.width >= 768 ) {
 *        console.log('On home page and window sized to 768 width or more.');
 *      } else {
 *        // otherwise, let's do this instead
 *        console.log('Not on home page, or window sized to less than 768.');
 *      }
 *
 *    }, timeToWaitForLast, "your-function-identifier-string"); }
 * });
 *
 * Pretty cool huh? You can create functions like this to conditionally load
 * content and other stuff dependent on the viewport.
 * Remember that mobile devices and javascript aren't the best of friends.
 * Keep it light and always make sure the larger viewports are doing the heavy lifting.
 *
 */

// Returns a function, that, as long as it continues to be invoked, will not
// be triggered. The function will be called after it stops being called for
// N milliseconds. If `immediate` is passed, trigger the function on the
// leading edge, instead of the trailing.
function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this,
      args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
 */
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
    jQuery(".comment img[data-gravatar]").each(function() {
      jQuery(this).attr("src", jQuery(this).attr("data-gravatar"));
    });
  }
} // end function

/*
 * Get IW Alerts (promise)
 */
function getAlerts() {
  return new Promise(function(resolve, reject) {
    jQuery
      .ajax({
        type: "GET",
        url: "https://alertas.ingenierowhite.com/api/alertas-vigentes"
      })
      .done(function(response) {
        resolve(response);
        // console.log(response);
      })
      .fail(function(error) {
        reject(error);
        // console.error(error);
      });
  });
}

function start_alerts_slider(alerts) {
  return new Swiper("#iwAlertasHome", {
    // Optional parameters
    direction: "horizontal",
    loop: true,
    // effect: 'fade',
    speed: 700,
    autoplay: {
      delay: 7000
    },
    // If we need pagination
    pagination: {
      el: ".swiper-pagination",
      bulletClass: "iw-slider-bullet",
      bulletActiveClass: "-active",
      // dynamicBullets: true,
      clickable: true,
      renderBullet: function(index, className) {
        var colorClass = `bg-color-${alerts[index]["nivel"]}`;
        return `<span class="${className} ${colorClass}"></span>`;
      }
    }
  });
}

function create_alerts_tempalte(alerts, type) {
  var alertsTmpl = alerts.map(function(alert) {
    switch (alert.nivel) {
      case "aviso":
        var alertIcon = "fa-bullhorn";
        break;
      case "importante":
        var alertIcon = "fa-bell";
        break;
      case "urgente":
        var alertIcon = "fa-exclamation-triangle";
        break;
      default:
        var alertIcon = "fa-bullhorn";
        break;
    }

    if (type == "slide") {
      return `
        <div id="alerta_${alert.id}" class="iw-alerta swiper-slide">
            <div class="iw-alerta-header">
                <div class="iw-alerta-label -inline text-color-${alert.nivel}">
                    <i class="fa ${alertIcon} fa-lg icono-alerta" aria-hidden="true"></i>
                    ${alert.nivel}
                </div>
                <a href="alertas#alerta_${alert.id}" class="iw-title-container bg-${alert.nivel}">
                    <h4 class="iw-alerta-titulo">${alert.titulo}</h4>
                </a>
            </div>
        </div>
      `;
    }

    if (type == "post") {
      return `
        <div id="alerta_${alert.id}" class="iw-alerta alerta-post offset-scroll-top">
            <div class="iw-alerta-header -flex">
                <div class="iw-alerta-label -block bg-color-${alert.nivel}">
                    <i class="fa ${alertIcon} fa-2x icono-alerta" aria-hidden="true"></i>
                    ${alert.nivel}
                </div>
                <div class="iw-title-container bg-${alert.nivel}">
                    <h4 class="iw-alerta-titulo">${alert.titulo}</h4>
                </div>
            </div>
            <div class="iw-full-content">
              <p class="iw-alerta-fecha">${alert.fecha_publicacion}</p>
              <p>${alert.contenido}</p>
            </div>
        </div>
      `;
    }
  });

  return alertsTmpl.join("");
}

function showSideMenu() {
  var $ = jQuery;
  $('body').addClass('show-sidemenu');

  $('.close-sidemenu').off('click')
  .on('click', function(e){
    if ($(this).attr('data-prevent') === 'true') e.preventDefault();

    hideSideMenu();
  });
}
function hideSideMenu() {
  var $ = jQuery;
  $('body').addClass('-closing');
  setTimeout(function(){
    $('.close-sidemenu').off('click');
    $('body').removeClass('show-sidemenu -closing');
  }, 320);
}

/*
 * Put all your regular jQuery in here.
 */
jQuery(document).ready(function($) {
  var alertMenuItem = $('.menu-item>a:contains("Alertas")');
  // Get alerts
  // var iwAlerts = null;
  getAlerts()
    .then(function(alerts) {
      // console.log(alerts);
      // test data
      // alerts.data = dummyAlertas;

      if (alerts.data.length > 0) {
        // Set nav bubble indication
        $(alertMenuItem).after(
          `<span class="bubble-indication">${alerts.data.length}</span>`
        );

        // Check for iwAlertHome element (Alerts in home page)
        if ($.contains(document, $("#iwAlertasHome")[0])) {
          var alertasSlides = create_alerts_tempalte(alerts.data, "slide");

          $("#iwAlertasHome")
            .removeClass("hidden")
            .find(".swiper-wrapper")
            .html(alertasSlides);

          var alertSlider = start_alerts_slider(alerts.data);

          $("#iwAlertasHome").hover(
            function() {
              alertSlider.autoplay.stop();
            },
            function() {
              alertSlider.autoplay.start();
            }
          );
        }

        // Check for iwAlertasSection element (Alerts in own section)
        if ($.contains(document, $("#iwAlertasSection")[0])) {
          var alertasPosts = create_alerts_tempalte(alerts.data, "post");

          $("#iwAlertasSection").html(alertasPosts);

          //Get URL hash
          var alertSelected = location.hash;

          if (alertSelected != "") {
            $("html, body").animate(
              { scrollTop: $(alertSelected).offset().top },
              300
            );
          }
        }
      } else {
        // No alerts
        $("#iwAlertasHome")
          .html("")
          .addClass("hidden");

        $("#iwAlertasSection").html(
          `<div class="row alert-no-items">
            <div class="col-xs center-xs middle-xs">
                <p><em>No hay alertas activas para msotrar</em></p>
            </div>
        </div>`
        );
      }
    })
    .catch(function(error) {
      console.error(error);
      $("#iwAlertasHome")
        .html("")
        .addClass("hidden");

      $("#iwAlertasSection").html(
        `<div class="row alert-no-items">
            <div class="col-xs center-xs middle-xs">
                <p><em>No hay alertas activas para msotrar</em></p>
            </div>
        </div>`
      );
    });
  /*
   * Let's fire off the gravatar function
   * You can remove this if you don't need it
   */
  loadGravatars();

  // Show side menu action btn
  $('.show-sidemenu-btn').off('click')
  .on('click', function(e){
    e.preventDefault();
    showSideMenu();
  });

  // Init collapsable sub menu
  $('.sub-menu.collapse').collapse('hide');

  // Toggle mobile subnav //NO ANDA//
  $('.mobile-nav .menu-item-has-children').off('click')
  .on('click', function(e){
    e.stopPropagation();
    e.preventDefault();

    var thisItem = this;
    var thisMenu = $(thisItem).find('.sub-menu');
    $(thisMenu).collapse('toggle');
  });

  var wrap = $("#container");
  var ventana = $(window);

  ventana.on("scroll", function() {
    if (ventana.scrollTop() > 220) {
      wrap.addClass("menu-fijo");
    } else {
      wrap.removeClass("menu-fijo");
    }
  });
}); /* end of as page load scripts */
