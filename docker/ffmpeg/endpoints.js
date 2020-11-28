exports.types = {
	wav: {
		extension: 'wav',
		outputOptions: [
			'-ac 1',
			'-ar 8000',
			'-acodec pcm_s16le',
			'-ab 128k'
		],
	},
}