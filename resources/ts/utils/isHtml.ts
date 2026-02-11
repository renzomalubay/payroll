/**
 * Checks if the message is an HTML string.
 * @param message - The message to check.
 * @returns True if it's HTML, false otherwise.
 */
export default function (message: any): boolean {
  if (!message) return false;
  if (typeof message !== 'string') return false;

  return message.startsWith('<!DOCTYPE html>') || message.startsWith('<html>') || message.startsWith('<script>');
}
