import React from 'react';
import ReactDOM from 'react-dom';
/* TODO slider chooser! */
class SliderAttachment extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return '';
    }
}


if (document.getElementById('slider-attachments')){
    ReactDOM.render(<SliderAttachment/>, document.getElementById('slider-attachments'))
}
