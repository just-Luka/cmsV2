import React from 'react';

export default function TypeOption(props){
    let dataTypes = props.types;
    let optionTypes = Object.keys(dataTypes).map((key, index) => {
        return (
            <option key={index} value={dataTypes[key].field}>{dataTypes[key].title}</option>
        )
    })

    return(
        <select value={props.selectVal} onChange={props.handleAction} className="custom-select" style={{width: "auto"}} >
            {optionTypes}
        </select>
    )
}
