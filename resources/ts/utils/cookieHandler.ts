export function getCookie(name: string): string | null {
  // Use decodeURIComponent on the cookie name to match the check.
  const cookieName = encodeURIComponent(name);
  const cookies = document.cookie.split('; ');

  for (const cookie of cookies) {
    const parts = cookie.split('=');
    // Check if the encoded name matches
    if (parts[0] === cookieName) {
      // Decode the value before returning
      const value = parts.length > 1 ? decodeURIComponent(parts[1]) : '';
      return value;
    }
  }
  return null;
}

export function setCookie(name: string, value: string, daysOrDate?: number | Date) {
  let expires = '';
  if (daysOrDate) {
    if (daysOrDate instanceof Date) {
      expires = `; expires=${daysOrDate.toUTCString()}`;
    } else {
      const date = new Date();
      date.setTime(date.getTime() + daysOrDate * 24 * 60 * 60 * 1000);
      expires = `; expires=${date.toUTCString()}`;
    }
  }

  document.cookie = `${encodeURIComponent(name)}=${encodeURIComponent(value)}; path=/${expires}`;
}
