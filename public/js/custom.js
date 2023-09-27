function print_view(div){
    var printContents = document.getElementById(div).innerHTML;
    var p_window = window.open('','Print','status=2');
    p_window.document.write('<!DOCTYPE html><html><head></head><body onafterprint="self.close()"></body></html>');
    p_window.document.head.innerHTML = document.head.innerHTML;
    p_window.document.body.innerHTML = printContents;
    p_window.print();
    p_window.close();
}        