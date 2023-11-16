/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./*.php",
    "./src/modulos/*.php"
  ],
  theme: {
    colors: {
      background: "#EFEFEF",
      resaltado: "#FBF2C6",
      color1: "#43281C",
      color2: "#333d29",
      color3: "#7F4F24",
      color4: "#B08968",
      color5: "#DDB892",
      color6: "#EDE0D4",
      color7: "#832424",
    },
    extend: {},
  },
  plugins: [require("./src/scripts/openVariant")],
};
