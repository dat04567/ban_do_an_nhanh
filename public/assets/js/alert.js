var Alert = undefined;

(function (Alert) {
   var alert, error, trash, info, success, warning, _container;

   info = function (message, title, options) {
      return alert('info', message, title, 'bi bi-info-circle', options);
   };

   warning = function (message, title, options) {
      return alert('warning', message, title, 'bi bi-exclamation-triangle', options);
   };

   error = function (message, title, options) {
      return alert('error', message, title, 'bi bi-exclamation-circle', options);
   };

   trash = function (message, title, options) {
      return alert('trash', message, title, 'bi bi-trash', options);
   };

   success = function (message, title, options) {
      return alert('success', message, title, 'bi bi-check-circle', options);
   };

   alert = function (type, message, title, icon, options) {
      var alertElem, messageElem, titleElem, iconElem, innerElem, _container;
      if (typeof options === 'undefined') {
         options = {};
      }
      options = $.extend({}, Alert.defaults, options);
      if (!_container) {
         _container = $('#alerts');
         if (_container.length === 0) {
            _container = $('<ul>').attr('id', 'alerts').appendTo($('body'));
         }
      }
      if (options.width) {
         _container.css({
            width: options.width,
         });
      }
      alertElem = $('<li>')
         .addClass('alert')
         .addClass('alert-' + type);
      setTimeout(function () {
         alertElem.addClass('open');
      }, 1);
      if (icon) {
         iconElem = $('<i>').addClass(icon);
         alertElem.append(iconElem);
      }
      innerElem = $('<div>').addClass('alert-block');
      alertElem.append(innerElem);
      if (title) {
         titleElem = $('<div>').addClass('alert-title').append(title);
         innerElem.append(titleElem);
      }
      if (message) {
         messageElem = $('<div>').addClass('alert-message').append(message);
         innerElem.append(messageElem);
      }
      if (options.displayDuration > 0) {
         setTimeout(function () {
            leave();
         }, options.displayDuration);
      } else {
         innerElem.append('<em>Click to Dismiss</em>');
      }
      alertElem.on('click', function () {
         leave();
      });

      function leave() {
         alertElem.removeClass('open');
         alertElem.one(
            'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend',
            function () {
               return alertElem.remove();
            }
         );
      }
      return _container.prepend(alertElem);
   };

   Alert.defaults = {
      width: '',
      icon: '',
      displayDuration: 3000,
      pos: '',
   };

   Alert.info = info;
   Alert.warning = warning;
   Alert.error = error;
   Alert.trash = trash;
   Alert.success = success;

   return (_container = void 0);
})(Alert || (Alert = {}));

this.Alert = Alert;

function showAlert(type, message, title, options) {
   if (options === void 0) {
      options = {};
   }
   switch (type) {
      case 'info':
         Alert.info(message, title, options);
         break;
      case 'warning':
         Alert.warning(message, title, options);
         break;
      case 'error':
         Alert.error(message, title, options);
         break;
      case 'trash':
         Alert.trash(message, title, options);
         break;
      case 'success':
         Alert.success(message, title, options);
         break;
   }
}
