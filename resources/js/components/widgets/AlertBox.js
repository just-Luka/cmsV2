import React from 'react';

function AlertBox(props){
    return (
        <div className="modal fade show" id="modal-default" style={{ display: "block", paddingRight: "15px" }}
             aria-modal="true">
            <div className="modal-dialog">
                <div className="modal-content">
                    <div className="modal-header">
                        <h4 className="modal-title">{$('#alert').html()} !</h4>
                        <button type="button" className="close" onClick={props.action} id="alert-cancel">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div className="modal-body">
                        <p>{$('#alert-comment').html()}</p>
                    </div>
                    <div className="modal-footer justify-content-between">
                        <button type="submit" className="btn btn-default" onClick={props.action} id="alert-close">{$('#alert-close').html()}</button>
                        <button type="submit" className="btn btn-primary" onClick={props.action} id="alert-pass">{$('#alert-continue').html()}</button>
                    </div>
                </div>
            </div>
        </div>

    )
}

export default AlertBox;
