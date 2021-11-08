import React from "react"
import Stopwatch from "../Stopwatch"

export default class DurationExercise extends React.Component {
    render() {
        return (
            <>
                <p>{this.props.name}</p>
                <Stopwatch></Stopwatch>
            </>
        )
    }
}