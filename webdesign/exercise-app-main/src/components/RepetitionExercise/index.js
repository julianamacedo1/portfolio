import React from "react"

export default class RepetitionExercise extends React.Component {
    constructor(props) {
        super(props)
        this.state = { value: this.props.value }
    }
    addOne() {
        this.setState((prevState) => {
            let newValue = prevState.value + 1
            this.props.updateValue(newValue)
            return {
                value: newValue,
            }
        })
    }
    reset() {
        this.setState((newValue) => {
            let resetValue = newValue.value = 0
            this.props.updateValue(resetValue)
            return {
                value: resetValue,
            }
        })
    }
    render() {
        return (
            <>
                <p>{this.props.name}</p>
                <p>Reps: {this.state.value}</p>
                <button onClick={() => this.addOne()} >Complete Rep</button>
                <button onClick={() => this.reset()} >Reset</button>
            </>
        )
    }
}