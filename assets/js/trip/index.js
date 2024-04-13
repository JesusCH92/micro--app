import tripController from "./tripController";
import tripModel from "./tripModel";

require('select2');

console.log('Esto es trips');

const controller = tripController({model: tripModel()});

controller.initAttributesFormEvents();
controller.initSendFormEvents();