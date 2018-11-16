function makeBotao() {
  
  $items = '';

  $.extend($.FroalaEditor.POPUP_TEMPLATES, {
    "customPlugin.popup": '[_BUTTONS_]'
  });

  $.ajax({
    dataType: "json",
    url: '../resources/assets/js/backend/falist.json',
    async: false, 
    success: function(data) {
      $items = data;  
    }
  });

  $.extend($.FroalaEditor.DEFAULTS, {
    popupButtons: $items,
  });

  $.FroalaEditor.PLUGINS.customPlugin = function (editor) {
    function initPopup () {
      var popup_buttons = '';

      if (editor.opts.popupButtons.length > 1) {
        popup_buttons += '<div class="fr-buttons">';
        popup_buttons += editor.button.buildList(editor.opts.popupButtons);
        popup_buttons += '</div>';
      }

      var template = {
        buttons: popup_buttons,
        custom_layer: '<div class="custom-layer">Hello World!</div>'
      };

      var $popup = editor.popups.create('customPlugin.popup', template);
      return $popup;
    }

    function showPopup () {
      var $popup = editor.popups.get('customPlugin.popup');
      if (!$popup) $popup = initPopup();
      editor.popups.setContainer('customPlugin.popup', editor.$tb);
      var $btn = editor.$tb.find('.fr-command[data-cmd="frfa"]');
      var left = $btn.offset().left + $btn.outerWidth() / 2;
      var top = $btn.offset().top + (editor.opts.toolbarBottom ? 10 : $btn.outerHeight() - 10);
      editor.popups.show('customPlugin.popup', left, top, $btn.outerHeight());
    }

    function hidePopup () {
      editor.popups.hide('customPlugin.popup');
    }

    return {
      showPopup: showPopup,
      hidePopup: hidePopup
    }
  }

  $.FroalaEditor.DefineIcon('buttonIcon', { NAME: 'star'})
  $.FroalaEditor.RegisterCommand('frfa', {
    title: 'FontAwesome',
    icon: 'buttonIcon',
    undo: false,
    focus: false,
    plugin: 'customPlugin',
    callback: function () {
      this.customPlugin.showPopup();
    }
  });

  $items.forEach(el => {
    $.FroalaEditor.DefineIcon(el, { NAME: el });
    $.FroalaEditor.RegisterCommand(el, {
      title: el,
      undo: false,
      focus: false,
      callback: function () {
        console.log('<i class="' + el + '"></i>');
        this.html.insert(el);
        this.customPlugin.hidePopup();
      }
    });
  })
}
