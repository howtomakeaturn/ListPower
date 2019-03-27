import React from 'react';
const uuidv4 = require('uuid/v4');

class App extends React.Component {
  constructor() {
    super();
    this.state = {
      sections: [
        {
          key: uuidv4(),
          label: '基本資訊',
          columns: [
            {
              key: uuidv4(),
              label: '資訊欄位1',
              type: 'string',
            },
            {
              key: uuidv4(),
              label: '資訊欄位2',
              type: 'string',
            },
            {
              key: uuidv4(),
              label: '資訊欄位3',
              type: 'string',
            },
          ]
        }
      ]
    };

    this.handleAddSection = this.handleAddSection.bind(this)
    this.handleAddColumn = this.handleAddColumn.bind(this)
    this.handleDeleteColumn = this.handleDeleteColumn.bind(this)
    this.handleChangeSection = this.handleChangeSection.bind(this)
    this.handleChangeColumn = this.handleChangeColumn.bind(this)
  }

  componentDidMount() {
    if (this.props.sections) {
      this.setState({ sections: JSON.parse(this.props.sections) });
    }
  }

  handleDeleteSection(key) {
    this.setState({
      sections: this.state.sections.filter(section => key !== section.key)
    })
  }

  handleAddSection() {
    this.setState({
      ...this.state,
      sections: [...this.state.sections, {
        key: uuidv4(),
        label: '其他資訊',
        columns: [
          {
            key: uuidv4(),
            label: '資訊欄位1',
            type: 'string',
          },
          {
            key: uuidv4(),
            label: '資訊欄位2',
            type: 'string',
          },
          {
            key: uuidv4(),
            label: '資訊欄位3',
            type: 'string',
          },
        ]
      }]
    })
  }

  handleAddColumn(key) {
    this.setState({
      sections: this.state.sections.map(section => {
        if (section.key === key) {
          return {
            ...section,
            columns: [
              ...section.columns,
              {
                key: uuidv4(),
                type: 'string',
                label: '',
              }
            ]
          }
        } else {
          return section
        }
      })
    })
  }

  handleDeleteColumn(key) {
    this.setState({
      sections: this.state.sections.map(section => {
        return {
          ...section,
          columns: section.columns.filter((column, i) => key !== column.key)
        }
      })
    })
  }

  handleGoUp(key) {
    let index, sectionIndex

    this.state.sections.map((section, i) => {
      section.columns.map((column, j) => {
        if (column.key === key) {
          index = j
          sectionIndex = i
        }
      })
    })

    let up = this.state.sections[sectionIndex].columns[index - 1]
    let down = this.state.sections[sectionIndex].columns[index]

    let newColumns = this.state.sections[sectionIndex].columns
    newColumns[index] = up
    newColumns[index - 1] = down

    this.setState({
      sections: this.state.sections.map((section, i) => {
        if (i === sectionIndex) {
          return { ...section, columns: newColumns }
        } else {
          return section
        }
      })
    })
  }

  handleGoDown(key) {
    let index, sectionIndex

    this.state.sections.map((section, i) => {
      section.columns.map((column, j) => {
        if (column.key === key) {
          index = j
          sectionIndex = i
        }
      })
    })

    let up = this.state.sections[sectionIndex].columns[index]
    let down = this.state.sections[sectionIndex].columns[index + 1]

    let newColumns = this.state.sections[sectionIndex].columns
    newColumns[index + 1] = up
    newColumns[index] = down

    this.setState({
      sections: this.state.sections.map((section, i) => {
        if (i === sectionIndex) {
          return { ...section, columns: newColumns }
        } else {
          return section
        }
      })
    })
  }

  canGoUpSection(key) {
    let index, sectionIndex

    this.state.sections.map((section, i) => {
      section.columns.map((column, j) => {
        if (column.key === key) {
          index = j
          sectionIndex = i
        }
      })
    })

    if (index !== 0) return false

    if (sectionIndex === 0) return false

    return true
  }

  canGoDownSection(key) {
    let index, sectionIndex

    this.state.sections.map((section, i) => {
      section.columns.map((column, j) => {
        if (column.key === key) {
          index = j
          sectionIndex = i
        }
      })
    })

    if (index !== this.state.sections[sectionIndex].columns.length - 1) return false

    if (sectionIndex === this.state.sections.length - 1) return false

    return true
  }

  handleGoUpSection(key) {
    let currentColumn, currentSectionIndex

    this.state.sections.map((section, i) => {
      section.columns.map((column, j) => {
        if (column.key === key) {
          currentColumn = column
          currentSectionIndex = i
        }
      })
    })

    let newSections = this.state.sections

    newSections[currentSectionIndex - 1].columns.push(currentColumn)

    newSections[currentSectionIndex].columns.splice(0, 1)

    this.setState({
      sections: newSections
    })
  }

  handleGoDownSection(key) {
    let currentColumn, currentSectionIndex

    this.state.sections.map((section, i) => {
      section.columns.map((column, j) => {
        if (column.key === key) {
          currentColumn = column
          currentSectionIndex = i
        }
      })
    })

    let newSections = this.state.sections

    newSections[currentSectionIndex + 1].columns.unshift(currentColumn)

    newSections[currentSectionIndex].columns.splice(-1, 1)

    this.setState({
      sections: newSections
    })
  }

  handleChangeSection(key, e) {
    this.setState({
      sections: this.state.sections.map(section => {
        if (section.key === key) {
          return { ...section, label: e.target.value }
        } else {
          return section
        }
      })
    })
  }

  handleChangeColumn(key, e) {
    this.setState({
      sections: this.state.sections.map(section => {
        return {
          ...section,
          columns: section.columns.map(column => {
            if (column.key === key) {
              return { ...column, label: e.target.value }
            } else {
              return column
            }
          })
        }
      })
    })
  }

  handleChangeColumnType(key, e) {
    this.setState({
      sections: this.state.sections.map(section => {
        return {
          ...section,
          columns: section.columns.map(column => {
            if (column.key === key) {
              return { ...column, type: e.target.value }
            } else {
              return column
            }
          })
        }
      })
    })
  }

  renderSections() {
    const sections = this.state.sections.map((object, i) => {

      const rows = this.renderRows(object);

      return <div key={object.key}>
        <hr className="mb-0" />
        <div className="">
          <div className="row info-section-setting-row">
            <div className="col-md-5">
                <div className="mt-3"><b>區塊名稱</b></div>
                <div className="row no-gutters mt-3">
                  <div className="col-9">
                    <input type="text" className="form-control" onChange={(e) => this.handleChangeSection(object.key, e)} defaultValue={object.label} />
                  </div>
                  <div className="col-2 ml-2">
                    <button type="button" onClick={() => this.handleDeleteSection(object.key)} className="btn btn-default"><i className="fas fa-times"></i></button>
                  </div>
                </div>
            </div>
            <div className="col-md-6">
              <div className="row no-gutters">
                <div className="col-4 col-md-4">
                  <div className="mt-3"><b>欄位類型</b></div>
                </div>
                <div className="col-4 col-md-4 ml-2">
                  <div className="mt-3"><b>欄位名稱</b></div>
                </div>
              </div>
              { rows }
              { object.columns.length === 0 && <div className="mt-3 text-muted">
                  這個區塊尚無欄位。
                </div>
              }
              <div className="mt-3">
                <button type="button" onClick={() => this.handleAddColumn(object.key)} className="btn btn-default"><i className="fas fa-plus-circle"></i>&nbsp; 增加一欄</button>
              </div>
            </div>
          </div>
        </div>
      </div>;

    });

    return sections;
  }

  renderRows(object) {
    const rows = object.columns.map((column, j) => {
      return <div className="mt-3" key={column.key}>
        <div className="row no-gutters info-column-setting-row">
          <div className="col-4">
            <select className="form-control" value={column.type} onChange={(e) => this.handleChangeColumnType(column.key, e)}>
              <option value="string">文字</option>
              <option value="address">地址</option>
              <option value="city">城市選單</option>
            </select>
          </div>
          <div className="col-4">
            <div className="pl-2">
              <input type="text" className="form-control" onChange={(e) => this.handleChangeColumn(column.key, e)} defaultValue={column.label} />
            </div>
          </div>
          <div className="col-4">
            <div className="pl-2">
              {/* up button */}
              { j === 0 && !this.canGoUpSection(column.key) &&
                <button type="button" className="btn btn-default btn-sm invisible">
                    <i className="fas fa-chevron-up"></i>
                </button>
              }
              { j !== 0 &&
                <button type="button" className="btn btn-default btn-sm up"
                  onClick={() => this.handleGoUp(column.key)}
                >
                    <i className="fas fa-chevron-up"></i>
                </button>
              }
              { this.canGoUpSection(column.key) &&
                <button type="button" className="btn btn-default btn-sm up"
                  onClick={() => this.handleGoUpSection(column.key)}
                >
                    <i className="fas fa-chevron-up"></i>
                </button>
              }
              {/* down button */}
              { j === (object.columns.length - 1) && !this.canGoDownSection(column.key) &&
                <button type="button" className="btn btn-default btn-sm ml-1 invisible">
                    <i className="fas fa-chevron-down"></i>
                </button>
              }
              { j !== (object.columns.length - 1) &&
                <button type="button" className="btn btn-default btn-sm ml-1 down"
                  onClick={() => this.handleGoDown(column.key)}
                >
                  <i className="fas fa-chevron-down"></i>
                </button>
              }
              { this.canGoDownSection(column.key) &&
                <button type="button" className="btn btn-default btn-sm ml-1 down"
                  onClick={() => this.handleGoDownSection(column.key)}
                >
                    <i className="fas fa-chevron-down"></i>
                </button>
              }
              <button type="button" onClick={() => this.handleDeleteColumn(column.key)} className="btn btn-default btn-sm ml-1"><i className="fas fa-times"></i></button>
            </div>
          </div>
        </div>
      </div>;
    });

    return rows;
  }

  render() {

    $('#info-columns-setting-state').val(JSON.stringify(this.state.sections));

    const sections = this.renderSections();

    return (
      <div>
        { sections }
        { this.state.sections.length === 0 && <div className="mt-3 text-muted">
            <hr />
            無資訊區塊。
          </div>
        }
      <hr />
        <div className="mt-3">
          <button type="button" onClick={this.handleAddSection} className="btn btn-default button-add-section"><i className="fas fa-plus-circle"></i>&nbsp; 增加區塊</button>
        </div>
      </div>
    );
  }
}

export default App;
