import React from 'react';
const uuidv4 = require('uuid/v4');

class App extends React.Component {
  constructor() {
    super();
    this.state = {
      columns: [
        {
          key: uuidv4(),
          label: '評分欄位1'
        },
        {
          key: uuidv4(),
          label: '評分欄位2'
        },
        {
          key: uuidv4(),
          label: '評分欄位3'
        },
      ]
    };

    this.handleAdd = this.handleAdd.bind(this)
  }

  componentDidMount() {
    if (this.props.columns) {
      this.setState({ columns: JSON.parse(this.props.columns) });
    }
  }

  handleDelete(key) {
    this.setState({
      columns: this.state.columns.filter((column, i) => key !== column.key)
    })
  }

  handleGoUp(key) {
    let index
    this.state.columns.map((column, i) => {
      if (column.key === key) {
        index = i
      }
    })

    let up = this.state.columns[index - 1]
    let down = this.state.columns[index]

    let newColumns = this.state.columns
    newColumns[index] = up
    newColumns[index - 1] = down

    this.setState({ columns: newColumns })
  }

  handleGoDown(key) {
    let index
    this.state.columns.map((column, i) => {
      if (column.key === key) {
        index = i
      }
    })

    let up = this.state.columns[index]
    let down = this.state.columns[index + 1]

    let newColumns = this.state.columns
    newColumns[index] = down
    newColumns[index + 1] = up

    this.setState({ columns: newColumns })
  }

  handleAdd() {
    this.setState({
      ...this.state,
      columns: [...this.state.columns, {
        key: uuidv4(),
        label: '',
      }]
    })
  }

  handleChange(key, e) {
    this.setState({
      columns: this.state.columns.map(column => {
        if (column.key === key) {
          return { ...column, label: e.target.value }
        } else {
          return column
        }
      })
    })
  }

  renderRows() {
    const rows = this.state.columns.map((object, i) => {
        return <div className="mt-3" key={object.key}>
          <div className="row no-gutters review-column-setting-row">
            <div className="col-md-2 col-4">
              <input type="text" className="form-control" onChange={(e) => this.handleChange(object.key, e)} defaultValue={object.label} />
            </div>
            <div className="col-8">
              <div className="pl-2">
                { i === 0 &&
                  <button type="button" className="btn btn-default btn-sm invisible">
                      <i className="fas fa-chevron-up"></i>
                  </button>
                }
                { i !== 0 &&
                  <button type="button" className="btn btn-default btn-sm up"
                    onClick={() => this.handleGoUp(object.key)}
                  >
                      <i className="fas fa-chevron-up"></i>
                  </button>
                }
                { i === (this.state.columns.length - 1) &&
                  <button type="button" className="btn btn-default btn-sm invisible">
                      <i className="fas fa-chevron-down"></i>
                  </button>
                }
                { i !== (this.state.columns.length - 1) &&
                  <button type="button" className="btn btn-default btn-sm ml-1 down"
                    onClick={() => this.handleGoDown(object.key)}
                  >
                    <i className="fas fa-chevron-down"></i>
                  </button>
                }
                <button type="button" className="btn btn-default btn-sm ml-1" onClick={() => this.handleDelete(object.key)}><i className="fas fa-times"></i></button>
              </div>
            </div>
          </div>
        </div>;
    });

    return rows
  }

  render() {

    $('#review-columns-setting-state').val(JSON.stringify(this.state.columns));

    const rows = this.renderRows();

    return (
      <div>
        <div className="mt-3">
          <div className="row">
            <div className="col-4">
              <b>欄位名稱</b>
            </div>
          </div>
        </div>
        { rows }
        { this.state.columns.length === 0 && <div className="mt-3 text-muted">
            無評分欄位。
          </div>
        }
        <div className="mt-3">
          <button type="button" className="btn btn-default" onClick={this.handleAdd}><i className="fas fa-plus-circle"></i>&nbsp; 增加一欄</button>
        </div>
      </div>
    );
  }
}
export default App;
