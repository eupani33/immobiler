import './styles/global.scss'
import './styles/app.css'

import { startStimulusApp } from '@symfony/stimulus-bridge';
  
export const app = startStimulusApp(require.context(
    '@symfony/stimulus-bridge/lazy-controller-loader!./controllers',
    true,
    /\.(j|t)sx?$/
));
const $ = require('jquery');
require('bootstrap');
require('bootstrap-table');
