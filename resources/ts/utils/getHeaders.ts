export default function () {
  return {
    'X-CSRF-TOKEN': document.getElementById('csrf-token')?.getAttribute('content') || '',
  };
}
