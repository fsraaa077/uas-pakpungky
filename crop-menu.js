const sharp = require("sharp");
const fs = require("fs");
const archiver = require("archiver");

const inputFile = "menu.jpg"; // ganti sesuai nama file gambar menu aslimu
const outputDir = "menu-images";

if (!fs.existsSync(outputDir)) {
  fs.mkdirSync(outputDir);
}

const menus = [
  { name: "hemat-a.png", left: 780, top: 40, width: 260, height: 230 },
  { name: "mix-b.png", left: 1090, top: 40, width: 260, height: 230 },
  { name: "mix-c.png", left: 1400, top: 40, width: 260, height: 230 },
  { name: "mix-d.png", left: 780, top: 320, width: 260, height: 230 },
  { name: "mix-e.png", left: 1090, top: 320, width: 260, height: 230 },
  { name: "chicken-teriyaki-a.png", left: 90, top: 40, width: 330, height: 250 },
  { name: "beef-teriyaki-a.png", left: 90, top: 320, width: 330, height: 250 },
  { name: "chicken-teriyaki-b.png", left: 450, top: 40, width: 280, height: 250 },
  { name: "beef-teriyaki-b.png", left: 450, top: 320, width: 280, height: 250 },
  { name: "chicken-katsu.png", left: 1400, top: 320, width: 260, height: 230 },
  { name: "chicken-spicy.png", left: 1720, top: 40, width: 260, height: 230 },
];

(async () => {
  for (const menu of menus) {
    await sharp(inputFile)
      .extract({ left: menu.left, top: menu.top, width: menu.width, height: menu.height })
      .toFile(`${outputDir}/${menu.name}`);
    console.log(`✅ Saved: ${menu.name}`);
  }

  // buat ZIP otomatis
  const output = fs.createWriteStream("menu-images.zip");
  const archive = archiver("zip", { zlib: { level: 9 } });

  archive.pipe(output);
  archive.directory(outputDir, false);
  await archive.finalize();

  console.log("📦 ZIP file created: menu-images.zip");
})();
