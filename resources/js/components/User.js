import React from 'react';
import ReactDOM from 'react-dom';
import Pagination from "./widgets/Pagination";
import AlertBox from "./widgets/AlertBox";
import Date from "./Libs/Date";

function capitalizeFirstLetter([ first, ...rest ], locale = navigator.language) {
    return [ first.toLocaleUpperCase(locale), ...rest ].join('');
}

function TypeOption(props) {
    let dataTypes = props.types;
    let optionTypes = Object.keys(dataTypes).map((key, index) => {
        return (
            <option key={index} value={dataTypes[key].id}>{capitalizeFirstLetter(dataTypes[key].status ? dataTypes[key].status : 'All')}</option>
        )
    })

    return(
        <select value={props.selectVal} onChange={props.handleAction} className="custom-select" style={{width: "auto"}} >
            {optionTypes}
        </select>
    )
}


function UserList(props) {
    let users = props.userData;
    let timeConvert = function (realtime) {
        return new Date(realtime)
    }
    return Object.keys(users).map((key, index) => {
        return (
            <div className="col-12 col-sm-6 col-md-4 d-flex align-items-stretch " key={users[key].id} id="draggable">
                <div className="card bg-light">
                    <div className="card-header text-muted border-bottom-0">
                        {users[key].status ? users[key].status : 'User'}
                    </div>
                    <div className="card-body pt-0">
                        <div className="row">
                            <div className="col-7">
                                <h2 className="lead"><b>{users[key].name}</b></h2>
                                <br/>
                                <br/>
                                <ul className="ml-4 mb-0 fa-ul text-muted">
                                    <li className="small"><span className="fa-li"><i className="fas fa-home"/></span> Register date : {timeConvert(users[key].created_at).YMD()}</li>
                                    <li className="small"><span className="fa-li"><i className="fas fa-envelope"/></span> Email : {users[key].email}</li>
                                    <li className="small"><span className="fa-li"><i className="fas fa-angle-double-right"/></span>Status: {
                                        users[key].email_verified_at ? <span style={{"color": "green"}}>confirmed</span> : <span style={{"color": "red"}}>unconfirmed</span>
                                    }
                                    </li>
                                </ul>
                            </div>
                            <div className="col-5 text-center">
                                { users[key].image
                                    ? <img src={window.location.origin+"/storage/"+users[key].image} alt="" className="img-circle img-fluid"/>
                                    : <img src={window.location.origin+"/adminLTE/img/default-avatar.png"} alt="" className="img-circle img-fluid"/>
                                }
                            </div>
                        </div>
                    </div>
                    <div className="card-footer">
                        <div className="text-right">
                            <a href={window.location.origin+'/manage/'+$('html').attr('lang')+'/users/destroy/'+users[key].id} onClick={props.userAction} className="btn btn-sm bg-danger" style={{"marginRight": 2}}>
                                <i className="fas fa-times" />
                            </a>
                            <a href={window.location.origin+'/manage/'+$('html').attr('lang')+'/users/edit/'+users[key].id} className="btn btn-sm bg-warning" style={{"marginRight":1}}>
                                <i className="fas fa-edit"/>
                            </a>
                            <a href="#" className="btn btn-sm btn-primary">
                                <i className="fas fa-user"/>View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        )
    })
}

class User extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            url: window.location.origin+'/manage/'+$('html').attr('lang')+'/users/show',
            userList: [],
            pagInfo: [],
            userType: '',
            availableStatus: [],
            warning: '',
            renderTime: 0,
        };
        this.handlePagination = this.handlePage.bind(this)
        this.handleChangeType = this.handleStatus.bind(this)
        this.handleClick = this.alertUser.bind(this)
        this.handleMutation = this.handleMutations.bind(this)
    }

    componentDidUpdate(prevProps, prevState, snapshot) {
        if(prevState.url !== this.state.url || prevState.userType !== this.state.userType || prevState.renderTime != this.state.renderTime){
            this.updateUserProps()
        }
    }

    componentDidMount() {
        this.updateUserProps()
        this.updateRoleProps()
    }

    handlePage(event) {
        event.preventDefault()
        this.setState({
            url: event.target.href
        })
    }

    handleStatus(event) {
        this.setState({
            userType: event.target.value
        })
    }

    updateUserProps() {
        this.fetchUsers()
            .then((res) => {
                this.setState({
                    userList: res.data,
                    pagInfo: res
                })
            })
    }
    updateRoleProps() {
        this.fetchRoles()
            .then((res) => {
                res.push({'status': '', 'id': ''})
                this.setState({
                    availableStatus: res
                })
            })
    }

    alertUser(e) {
        e.preventDefault()
        this.setState({
            warning: e.target.href
        })
    }
    handleMutations(e) {
        if (e.target.id === 'alert-pass'){
            $.ajax({
                url: this.state.warning,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            this.setState({
                warning : '',
                renderTime: this.state.renderTime + 1
            })
        }else{
            this.setState({
                warning : ''
            })
        }
    }

    fetchUsers() {
        return new Promise((resolve) => {
            $.ajax({
                url: this.state.url,
                type: "GET",
                dataType: "json",
                data: {
                    'order': '',
                    'roleID': this.state.userType
                },
                success: function (response) {
                    resolve(response)
                    console.log(response)
                }
            })
        })
    }

    fetchRoles() {
        return new Promise((resolve) => {
            $.ajax({
                url: window.location.origin+'/manage/'+$('html').attr('lang')+'/roles/show',
                type: 'GET',
                dataType: 'json',
                data: {
                  'status': this.state.userType
                },
                success: function (response) {
                    resolve(response)
                }
            })
        })
    }

    render() {
        return (
            <section className="content">
                <div className="card card-solid">
                    <div className="card-body pb-0">
                        <div className="dataTables_length" id="example1_length">
                            <label>
                               <TypeOption types={this.state.availableStatus} selectVal={this.state.userType} handleAction={this.handleChangeType} />
                            </label>
                        </div>
                        <div className="row d-flex align-items-stretch">
                            <UserList userAction={this.handleClick} userData={this.state.userList}/>
                        </div>
                    </div>
                    <Pagination pagData={this.state.pagInfo} actionPage={this.handlePagination}/>
                </div>
                {this.state.warning ? <AlertBox action={this.handleMutation}/> :null}
            </section>
        )
    }
}

if (document.getElementById('user-list')){
    ReactDOM.render(<User/>, document.getElementById('user-list'))
}
