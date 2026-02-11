/* eslint-disable @typescript-eslint/no-unused-vars */
import { flatten, merge } from 'lodash';
import Swal, { SweetAlertOptions, SweetAlertResult } from 'sweetalert2';

// Set default options for the SweetAlert2 library
const defaultOptions: SweetAlertOptions = {
  confirmButtonColor: '#4e73df',
  icon: 'success',
};

// @ts-ignore
export default function swal<any>(options: SweetAlertOptions): Promise<SweetAlertResult<any>> {
  // Merge the default options with the provided options and return the result of the Swal.fire function
  return Swal.fire(merge({}, defaultOptions, options));
}

// eslint-disable-next-line @typescript-eslint/naming-convention
export const Toast = Swal.mixin({
  // Set the toast options for the SweetAlert2 library
  toast: true,
  position: 'bottom-end',
  showConfirmButton: false,
  showCloseButton: true,
  didOpen: (toast) => {
    // Stop the timer when the mouse enters the toast
    toast.onmouseenter = Swal.stopTimer;
    // Resume the timer when the mouse leaves the toast
    toast.onmouseleave = Swal.resumeTimer;
  },
});

// @ts-ignore
export function toast<any>(options: SweetAlertOptions) {
  // Merge the default options with the provided options
  const mergedOptions = merge({}, defaultOptions, options);

  // Return the result of the Toast.fire function
  return Toast.fire(mergedOptions);
}

// @ts-ignore
export function showLoader<any>(options: SweetAlertOptions | string = {}) {
  const config = typeof options === 'string' ? { title: options } : options;
  const swalInstance = swal(
    merge<SweetAlertOptions, SweetAlertOptions>(
      {
        title: 'Please wait...',
        icon: 'info',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
      },
      config
    )
  );
  Swal.showLoading();
  return swalInstance;
}

// @ts-ignore
export function showError<any>(options: SweetAlertOptions | string = {}) {
  const config = typeof options === 'string' ? { title: options } : options;
  const swalInstance = swal(merge<SweetAlertOptions, SweetAlertOptions>({ icon: 'error' }, config));
  return swalInstance;
}

export function jqueryErrorSwal(data: JQuery.jqXHR<any>) {
  // do nothing if aborted
  if (data.statusText === 'abort') return;

  // handle page expired
  if (data.status === 419) return window.location.reload();

  let html = '';
  let title = data.responseJSON?.title ?? data.statusText;
  let showCancelButton = false;

  // prevent swal from showing messages that contains script or html
  if (isHtml(data.responseText)) {
    html = '';
    // @ts-ignore
    showCancelButton = import.meta.env.VITE_APP_ENV !== 'production';
  } else {
    const errResponse = data.responseJSON?.message ?? '';
    html = flatten(errResponse).join('<br />');

    if (!html) {
      // ajax successfully connected to the server but the server may have returned an error
      title = 'Error';
      html = data.responseJSON?.error;
    }
  }

  // Display error message
  swal({
    title,
    html,
    icon: 'error',
    showCancelButton,
    cancelButtonText: 'View Error',
  }).then((result) => {
    if (result.dismiss === Swal.DismissReason.cancel) {
      // Open a new tab to display error details
      const newWindow = window.open();
      if (newWindow) {
        if (data.responseText.startsWith('<!DOCTYPE html>')) {
          newWindow.document.write(data.responseText);
          newWindow.stop();
        } else {
          newWindow.document.body.outerHTML = data.responseText;
        }
      }
    }
  });
}

/**
 * Checks if a message starts with HTML or script tag.
 */
function isHtml(message: string) {
  return message?.startsWith('<!DOCTYPE html>') || message?.startsWith('<html>') || message?.startsWith('<script>');
}
