/**
 * Cookie Helper Utilities
 *
 * Helper untuk mengelola cookies pada sisi klien (browser).
 * Digunakan untuk menyimpan, membaca, dan menghapus JWT token.
 */

/**
 * Menyimpan cookie.
 *
 * @param {string} name   - Nama cookie.
 * @param {string} value  - Nilai cookie.
 * @param {number} expiry - Durasi dalam detik sebelum cookie kadaluarsa.
 */
export function setCookie(name, value, expiry) {
  const date = new Date();
  date.setTime(date.getTime() + expiry * 1000);
  const expires = "expires=" + date.toUTCString();
  document.cookie = `${name}=${value};${expires};path=/;SameSite=Strict`;
}

/**
 * Membaca nilai cookie berdasarkan nama.
 *
 * @param {string} name - Nama cookie yang ingin dibaca.
 * @returns {string|null} Nilai cookie atau null jika tidak ditemukan.
 */
export function getCookie(name) {
  const nameEQ = name + "=";
  const cookies = document.cookie.split(";");

  for (let i = 0; i < cookies.length; i++) {
    let c = cookies[i].trim();
    if (c.indexOf(nameEQ) === 0) {
      return c.substring(nameEQ.length, c.length);
    }
  }

  return null;
}

/**
 * Menghapus cookie berdasarkan nama.
 *
 * @param {string} name - Nama cookie yang ingin dihapus.
 */
export function deleteCookie(name) {
  document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;SameSite=Strict`;
}

/**
 * Nama cookie yang digunakan untuk menyimpan JWT token.
 */
export const TOKEN_COOKIE_NAME = "jwt_token";
