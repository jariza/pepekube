#!/bin/bash
set -e

# setup ros environment
source "/opt/ros/$ROS_DISTRO/setup.bash"

export ROS_IP=`hostname -I|tr -d ' '`
roscore -v
