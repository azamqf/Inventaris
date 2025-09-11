// tailwind.config.js
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        // Warna utama tema kepolisian
        navy: "#1F2A44",       // Primary
        navyDark: "#2C3E50",   // Secondary
        maroon: "#D32F2F",     // Accent / Danger
        maroonDark: "#B71C1C", // Hover / Darker danger
        lightGray: "#F4F4F4",  // Background netral
        darkText: "#212121",   // Teks utama
      },
    },
  },
  plugins: [],
}
