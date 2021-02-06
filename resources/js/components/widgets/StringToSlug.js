import React from 'react'
import ReactDOM from 'react-dom'
const slugify = require('slugify')

class StringToSlug extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            slug: '',
        }
        this.handleChange = this.handleSlug.bind(this)
    }
    handleSlug(e) {
        this.setState({
            slug: slugify(e.target.value, {
                lower: true
            })
        })
    }
    render() {
        return (
            <div>
                <div className="form-group">
                    <label>Slug</label>
                    <input type="text" onChange={this.handleChange} className="form-control" placeholder="Slug" required/>
                </div>
                <div className="form-group">
                    <label>Generated slug</label>
                    <input type="text" value={this.state.slug} id="generate-slug" name="slug" className="form-control" placeholder="Slug" readOnly/>
                </div>
            </div>
        )
    }
}

if (document.getElementById('string-to-slug')){
    ReactDOM.render(<StringToSlug/>, document.getElementById('string-to-slug'))
}
