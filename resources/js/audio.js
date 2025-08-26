window.audioRecorder = function() {
    return {
        isRecording: false,
        mediaRecorder: null,
        audioChunks: [],
        audioBlob: null,
        audioUrl: null,
        recordingTime: 0,
        timer: null,

        async init() {
            // Request microphone permission
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ audio: true });
                this.mediaRecorder = new MediaRecorder(stream);
                this.setupRecorderEvents();
            } catch (error) {
                console.error('Error accessing microphone:', error);
                alert('Please allow microphone access to record audio');
            }
        },

        setupRecorderEvents() {
            this.mediaRecorder.ondataavailable = (event) => {
                this.audioChunks.push(event.data);
            };

            this.mediaRecorder.onstop = () => {
                this.audioBlob = new Blob(this.audioChunks, { type: 'audio/wav' });
                this.audioUrl = URL.createObjectURL(this.audioBlob);
                this.audioChunks = [];
            };
        },

        toggleRecording() {
            if (this.isRecording) {
                this.stopRecording();
            } else {
                this.startRecording();
            }
        },

        startRecording() {
            if (this.mediaRecorder && this.mediaRecorder.state === 'inactive') {
                this.audioChunks = [];
                this.mediaRecorder.start();
                this.isRecording = true;
                this.recordingTime = 0;
                this.startTimer();
            }
        },

        stopRecording() {
            if (this.mediaRecorder && this.mediaRecorder.state === 'recording') {
                this.mediaRecorder.stop();
                this.isRecording = false;
                this.stopTimer();
            }
        },

        startTimer() {
            this.timer = setInterval(() => {
                this.recordingTime++;
            }, 1000);
        },

        stopTimer() {
            if (this.timer) {
                clearInterval(this.timer);
                this.timer = null;
            }
        },

        formatTime(seconds) {
            const mins = Math.floor(seconds / 60);
            const secs = seconds % 60;
            return `${mins}:${secs.toString().padStart(2, '0')}`;
        },

        playAudio() {
            if (this.audioUrl) {
                const audio = new Audio(this.audioUrl);
                audio.play();
            }
        },

        deleteRecording() {
            this.audioBlob = null;
            this.audioUrl = null;
            this.recordingTime = 0;
        },

        // Upload audio to server
        async uploadAudio(orderId) {
            if (!this.audioBlob) return null;

            const formData = new FormData();
            formData.append('audio', this.audioBlob, 'recording.wav');
            formData.append('order_id', orderId);

            try {
                const response = await fetch('/api/upload-audio', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                });

                const result = await response.json();
                return result.audio_path;
            } catch (error) {
                console.error('Error uploading audio:', error);
                return null;
            }
        }
    }
}