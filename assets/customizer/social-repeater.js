(function ($) {
  function safeParse(json) {
    try {
      var v = JSON.parse(json);
      return Array.isArray(v) ? v : [];
    } catch (e) {
      return [];
    }
  }

  // Lokale TemplateSettings, damit Plugins uns nicht kaputt machen
  var localTplSettings = {
    evaluate: /<#([\s\S]+?)#>/g,
    interpolate: /<#=([\s\S]+?)#>/g,
    escape: /<#-([\s\S]+?)#>/g
  };

  function getTemplateFn() {
    var html = $("#tmpl-yourtheme-social-repeater-item").html();
    return _.template(html, localTplSettings);
  }

  function render($control, items, platforms) {
    var $list = $control.find(".yourtheme-social-repeater-items");
    var tplFn = getTemplateFn();

    $list.empty();

    items.forEach(function (item) {
      var $row = $(tplFn({ platforms: platforms }));
      $row.find(".yourtheme-social-repeater-platform").val(item.platform || "web");
      $row.find(".yourtheme-social-repeater-url").val(item.url || "");
      $list.append($row);
    });
  }

  function collect($control) {
    var items = [];
    $control.find(".yourtheme-social-repeater-item").each(function () {
      var platform = $(this).find(".yourtheme-social-repeater-platform").val() || "web";
      var url = $(this).find(".yourtheme-social-repeater-url").val() || "";
      items.push({ platform: platform, url: url });
    });
    return items;
  }

  function bind($control) {
    var $input = $control.find(".yourtheme-social-repeater-input");
    var platforms = (window.YourThemeSocialRepeater && YourThemeSocialRepeater.platforms) || [];

    var items = safeParse($input.val());
    render($control, items, platforms);

    $control.on("click", ".yourtheme-social-repeater-add", function () {
      items = safeParse($input.val());
      items.push({ platform: "web", url: "" });
      $input.val(JSON.stringify(items)).trigger("change");
      render($control, items, platforms);
    });

    $control.on("click", ".yourtheme-social-repeater-remove", function () {
      $(this).closest(".yourtheme-social-repeater-item").remove();
      var updated = collect($control);
      $input.val(JSON.stringify(updated)).trigger("change");
    });

    $control.on("change input", ".yourtheme-social-repeater-platform, .yourtheme-social-repeater-url", function () {
      var updated = collect($control);
      $input.val(JSON.stringify(updated)).trigger("change");
    });
  }

  $(function () {
    $(".yourtheme-social-repeater").each(function () {
      var $wrapper = $(this).closest(".customize-control");
      bind($wrapper);
    });
  });
})(jQuery);
