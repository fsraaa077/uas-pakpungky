const sharp = require("sharp");
const fs = require("fs");
const archiver = require("archiver");

const inputFile = "menu.jpg";

// daftar menu dengan area berdasarkan persentase
const menus = [
  { name: "hemat-a", top: 0.05, left: 0.65, width: 0.30, height: 0.18 },
  { name: "mix-b", top: 0.25, left: 0.65, width: 0.30, height: 0.18 },
  { name: "mix-c", top: 0.45, left: 0.65, width: 0.30, height: 0.18 },
  { name: "mix-d", top: 0.65, left: 0.65, width: 0.30, height: 0.18 },
  { name: "mix-e", top: 0.85, left: 0.65, width: 0.30, height: 0.18 },
  { name: "chicken-teriyaki-a", top: 0.05, left: 0.05, width: 0.25, height: 0.20 },
  { name: "beef-teriyaki-a", top: 0.30, left: 0.05, width: 0.25, height: 0.20 },
  { name: "chicken-teriyaki-b", top: 0.55, left: 0.05, width: 0.25, height: 0.20 },
  { name: "beef-teriyaki-b", top: 0.80, left: 0.05, width: 0.25, height: 0.20 }
];

async function cropMenus() {
  try {
    const meta = await sharp(inputFile).metadata();
    const { width, height } = meta;

    console.log(`Ukuran gambar: ${width}x${height}`);

    const outputZip = fs.createWriteStream("menu-images.zip");
    const archive = archiver("zip", { zlib: { level: 9 } });
    archive.pipe(outputZip);

    for (const menu of menus) {
      const extract = {
  left: Math.floor(menu.left * width),
  top: Math.floor(menu.top * height),
  width: Math.min(Math.floor(menu.width * width), width - Math.floor(menu.left * width)),
  height: Math.min(Math.floor(menu.height * height), height - Math.floor(menu.top * height)),
};


      const fileName = `${menu.name}.png`;

      console.log(`Mencrop ${fileName}...`, extract);

      const buffer = await sharp(inputFile)
        .extract(extract)
        .toFormat("png")
        .toBuffer();

      archive.append(buffer, { name: fileName });
    }

    await archive.finalize();
    console.log("✅ Semua menu berhasil dicrop dan disimpan di menu-images.zip");
  } catch (err) {
    console.error("❌ Error:", err);
  }
}

cropMenus();
