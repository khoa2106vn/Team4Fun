var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};

var clearFile = function(event) {
    var output = document.getElementById('output');
    output.src = '';
};

var loadFileEdit = function(event) {
    var output = document.getElementById('outputEdit');
    output.data = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.data) // free memory
    }
};

var clearFileEdit = function(event) {
    var output = document.getElementById('outputEdit');
    output.data = '';
};

function Nice($name) {
    var output = document.getElementById($name);
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};

function Reset($name) {
    var output = document.getElementById($name);
    output.src = '';
};