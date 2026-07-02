const sharp = require("sharp");

sharp("menu.jpg")
  .metadata()
  .then(info => {
    console.log("Metadata gambar:", info);
  })
  .catch(err => {
    console.error("Error:", err);
  });
