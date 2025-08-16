(function () {
  var primary = localStorage.getItem("primary") || "#1A4D07";
  var secondary = localStorage.getItem("secondary") || "#FE6A49";

  window.RihoAdminConfig = {
    // Theme Primary Color
    primary: primary,
    // theme secondary color
    secondary: secondary,
  };
})();
