function AlertNotify(versionB, titulo, texto, tipo) {
    
    new PNotify({
        styling: 'bootstrap3',
        title: titulo,
        text: texto,
        type: tipo,
        delay: 2000
    });
}