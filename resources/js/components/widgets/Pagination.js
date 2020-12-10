import React from 'react';
import ReactDOM from 'react-dom';

function Pages(props){
    let pagInfo = props.data
    let pagButtons = [];
    let disableL, disableR, prevPage, nextPage;

    disableL = pagInfo.current_page == 1 ? 'disabled' : ''
    prevPage = disableL ? '#' : pagInfo.prev_page_url

    disableR = pagInfo.current_page == pagInfo.last_page ? 'disabled' : ''
    nextPage = disableR ? '#' : pagInfo.next_page_url

    let i = pagInfo.current_page-5 <= 0 ? 1 : pagInfo.current_page-5;
    pagButtons.push(<li key="leftArrow" className={`page-item ${disableL}`}><a className="page-link" href={prevPage} onClick={props.action}>«</a></li>)
    for (i; i<=pagInfo.last_page; i++){
        if(pagInfo.current_page+5 < i){
            break
        }
        if (i == pagInfo.current_page){
            pagButtons.push(<li key={`page=${i}`} className="page-item active"><a className="page-link" href={pagInfo.path + `?page=${i}`} onClick={props.action}>{i}</a></li>)
            continue
        }
        pagButtons.push(<li key={`page=${i}`} className="page-item"><a className="page-link" href={pagInfo.path + `?page=${i}`} onClick={props.action}>{i}</a></li>)
    }
    pagButtons.push(<li key="rightArrow" className={`page-item ${disableR}`}><a className="page-link" href={nextPage} onClick={props.action}>»</a></li>)

    return (
        <ul className="pagination pagination-sm m-0 float-right" >
            {pagButtons}
        </ul>
    )
}

export default class Pagination extends React.Component{
    constructor(props) {         //pagData, actionPage->handlePagination
        super(props);
    }

    render(){
        return (
            <div className="card-footer clearfix">
                <Pages data={this.props.pagData} action={this.props.actionPage}/>
            </div>
        )
    }
}

